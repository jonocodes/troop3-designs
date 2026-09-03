// Median-cut quantizer that runs in Chromium via Playwright.
// Outputs an 8-bit indexed-color PNG, written manually to disk.

import { chromium } from '/nix/store/3iab0pil1izk2y8678crf2i40xn7gri9-playwright-test-1.61.1/lib/node_modules/playwright-core/index.mjs';
import fs from 'node:fs/promises';
import zlib from 'node:zlib';
import path from 'node:path';

const CHROME = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';
const DIR = '/home/jono/sync/more/troop3-designs/raw-html/images/ranks';

const browser = await chromium.launch({ executablePath: CHROME, args: ['--no-sandbox'] });
const ctx = await browser.newContext();
const page = await ctx.newPage();

const quantizerSrc = `
function quantize(rgba, maxColors) {
  // Fast: drop alpha, build color histogram, median-cut, map pixels.
  // Padding with white background first so transparency doesn't affect the histogram.
  const N = rgba.length / 4;
  const px = new Uint8Array(N * 3);
  for (let i = 0, j = 0; i < rgba.length; i += 4, j += 3) {
    const a = rgba[i+3];
    const r = rgba[i], g = rgba[i+1], b = rgba[i+2];
    px[j]   = Math.round((r * a + 255 * (255 - a)) / 255);
    px[j+1] = Math.round((g * a + 255 * (255 - a)) / 255);
    px[j+2] = Math.round((b * a + 255 * (255 - a)) / 255);
  }
  // Quantize each channel to 5 bits for histogram keys (32^3 = 32768 buckets max)
  const hist = new Map();
  for (let i = 0; i < N; i++) {
    const r = px[i*3], g = px[i*3+1], b = px[i*3+2];
    const key = ((r >> 3) << 10) | ((g >> 3) << 5) | (b >> 3);
    hist.set(key, (hist.get(key) || 0) + 1);
  }
  // Median-cut
  function cubeEntries(c) {
    return [...c.hist.entries()];
  }
  function splitCube(cube) {
    const dr = cube.rmax - cube.rmin, dg = cube.gmax - cube.gmin, db = cube.bmax - cube.bmin;
    let dim = 'r';
    if (dg > dr) dim = 'g';
    if (db > Math.max(dr, dg)) dim = 'b';
    const arr = cubeEntries(cube).map(([k, c]) => {
      const r = ((k >> 10) & 31) << 3, g = ((k >> 5) & 31) << 3, b = (k & 31) << 3;
      return { k, c, val: dim === 'r' ? r : dim === 'g' ? g : b };
    }).sort((a, b) => a.val - b.val);
    let total = 0; for (const e of arr) total += e.c;
    let half = 0;
    for (const e of arr) { half += e.c; if (half * 2 >= total) break; }
    const L = new Map(), R = new Map();
    let walked = 0;
    for (const e of arr) {
      (walked < half ? L : R).set(e.k, e.c);
      walked += e.c;
    }
    function summarize(m) {
      let rmin=255,rmax=0,gmin=255,gmax=0,bmin=255,bmax=0,t=0;
      for (const [k, c] of m) {
        const r = ((k >> 10) & 31) << 3, g = ((k >> 5) & 31) << 3, b = (k & 31) << 3;
        if (r<rmin)rmin=r; if (r>rmax)rmax=r; if (g<gmin)gmin=g; if (g>gmax)gmax=g; if (b<bmin)bmin=b; if (b>bmax)bmax=b;
        t += c;
      }
      return { hist: m, count: t, rmin, rmax, gmin, gmax, bmin, bmax };
    }
    return [summarize(L), summarize(R)];
  }
  let cubes = [{
    hist, count: N,
    rmin: 0, rmax: 255, gmin: 0, gmax: 255, bmin: 0, bmax: 255,
  }];
  while (cubes.length < maxColors) {
    let best = 0, bi = 0;
    for (let i = 0; i < cubes.length; i++) {
      if (cubes[i].count > best) { best = cubes[i].count; bi = i; }
    }
    if (best < 2) break;
    const [a, b] = splitCube(cubes[bi]);
    cubes.splice(bi, 1, a, b);
  }
  const palette = new Uint8Array(cubes.length * 3);
  for (let i = 0; i < cubes.length; i++) {
    let r=0,g=0,b=0,t=0;
    for (const [k, c] of cubes[i].hist) {
      const kr = ((k >> 10) & 31) << 3, kg = ((k >> 5) & 31) << 3, kb = (k & 31) << 3;
      r += kr*c; g += kg*c; b += kb*c; t += c;
    }
    palette[i*3]   = Math.round(r/t);
    palette[i*3+1] = Math.round(g/t);
    palette[i*3+2] = Math.round(b/t);
  }
  // Map each pixel to nearest palette entry
  const indices = new Uint8Array(N);
  const P = palette.length / 3;
  for (let i = 0; i < N; i++) {
    const r = px[i*3], g = px[i*3+1], b = px[i*3+2];
    let best = 0, bestD = Infinity;
    for (let p = 0; p < P; p++) {
      const dr = palette[p*3]-r, dg = palette[p*3+1]-g, db = palette[p*3+2]-b;
      const d = dr*dr + dg*dg + db*db;
      if (d < bestD) { bestD = d; best = p; }
    }
    indices[i] = best;
  }
  return { palette: Array.from(palette), indices: Array.from(indices) };
}
window.quantize = quantize;
`;

const files = ['rank-lion.png', 'rank-wolf.png', 'rank-webelos.png', 'rank-tiger.png', 'rank-bear.png', 'rank-aol.png'];

// CRC32 for PNG chunks
function crc32(buf) {
  let c;
  const table = [];
  for (let n = 0; n < 256; n++) {
    c = n;
    for (let k = 0; k < 8; k++) c = (c & 1) ? 0xedb88320 ^ (c >>> 1) : c >>> 1;
    table[n] = c;
  }
  let crc = 0xffffffff;
  for (let i = 0; i < buf.length; i++) crc = table[(crc ^ buf[i]) & 0xff] ^ (crc >>> 8);
  return (crc ^ 0xffffffff) >>> 0;
}
function chunk(type, data) {
  const len = Buffer.alloc(4); len.writeUInt32BE(data.length, 0);
  const typeBuf = Buffer.from(type, 'ascii');
  const crc = Buffer.alloc(4); crc.writeUInt32BE(crc32(Buffer.concat([typeBuf, data])), 0);
  return Buffer.concat([len, typeBuf, data, crc]);
}
function writePNG(width, height, palette, indices) {
  const sig = Buffer.from([0x89,0x50,0x4e,0x47,0x0d,0x0a,0x1a,0x0a]);
  const ihdr = Buffer.alloc(13);
  ihdr.writeUInt32BE(width, 0); ihdr.writeUInt32BE(height, 4);
  ihdr[8] = 8;   // bit depth
  ihdr[9] = 3;   // color type 3 = indexed
  ihdr[10] = 0;  // compression
  ihdr[11] = 0;  // filter
  ihdr[12] = 0;  // interlace
  // Build image data: each row prefixed with filter byte 0
  const rowLen = 1 + width;
  const raw = Buffer.alloc(rowLen * height);
  for (let y = 0; y < height; y++) {
    raw[y*rowLen] = 0;
    for (let x = 0; x < width; x++) {
      raw[y*rowLen + 1 + x] = indices[y*width + x];
    }
  }
  const idat = zlib.deflateSync(raw);
  const iend = Buffer.alloc(0);
  return Buffer.concat([
    sig,
    chunk('IHDR', ihdr),
    chunk('PLTE', Buffer.from(palette)),
    chunk('IDAT', idat),
    chunk('IEND', iend),
  ]);
}

for (const f of files) {
  const inPath = path.join(DIR, f);
  const data = await fs.readFile(inPath);
  const b64 = data.toString('base64');
  await page.setContent(`<!DOCTYPE html><html><body style="margin:0">
<script>${quantizerSrc}</script>
<img id=img src="data:image/png;base64,${b64}">
<canvas id=c></canvas>
</body></html>`);
  await page.waitForFunction(() => document.getElementById('img').complete && document.getElementById('img').naturalWidth > 0);

  const result = await page.evaluate(() => {
    const img = document.getElementById('img');
    const c = document.getElementById('c');
    c.width = img.naturalWidth; c.height = img.naturalHeight;
    const ctx = c.getContext('2d');
    ctx.drawImage(img, 0, 0);
    const pixels = ctx.getImageData(0, 0, c.width, c.height);
    const { palette, indices } = window.quantize(pixels.data, 32);
    return { w: c.width, h: c.height, palette, indices };
  });

  const png = writePNG(result.w, result.h, result.palette, result.indices);
  const before = data.length;
  const after = png.length;
  console.log(`${f}: ${before} -> ${after} bytes (${(after/before*100).toFixed(0)}%, ${result.palette.length/3} colors)`);
  await fs.writeFile(inPath, png);
}

await browser.close();
