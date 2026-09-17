#!/usr/bin/env node
// Smoke test for the templated build: run `npm run check`.
// Asserts all pages render, share one header/footer/script, and mark one active nav item.
const fs = require('fs');
const path = require('path');

const OUT = path.join(__dirname, '_site');
const EXPECTED_ACTIVE = { 'index.html': 'Home', 'join.html': 'Join', 'calendar.html': 'Calendar' };
const PAGES = Object.keys(EXPECTED_ACTIVE);

const fail = (msg) => {
  console.error(`FAIL ${msg}`);
  process.exitCode = 1;
};

const footerOf = (html) => {
  const m = html.match(/<footer[\s\S]*?<\/footer>/);
  return m ? m[0] : null;
};

const htmls = {};
for (const page of PAGES) {
  const file = path.join(OUT, page);
  if (!fs.existsSync(file)) {
    fail(`${page} not built`);
    continue;
  }
  const html = (htmls[page] = fs.readFileSync(file, 'utf8'));

  if (/{{|{%/.test(html)) fail(`${page} has unrendered template syntax`);
  if (!html.includes('<header class="header">')) fail(`${page} missing header`);
  if (!html.includes('class="mobile-menu"')) fail(`${page} missing mobile menu`);
  if (!html.includes('class="overlay"')) fail(`${page} missing menu overlay`);
  if (!footerOf(html)) fail(`${page} missing footer`);
  if (!html.includes('<script src="site.js" defer></script>')) fail(`${page} missing shared site.js`);
  if (!/<title>.+<\/title>/.test(html)) fail(`${page} missing title`);

  const active = [...html.matchAll(/<a href="[^"]*" class="active">([^<]*)<\/a>/g)].map((m) => m[1]);
  if (active.length !== 1 || active[0] !== EXPECTED_ACTIVE[page]) {
    fail(`${page} active nav is ${JSON.stringify(active)}, expected ["${EXPECTED_ACTIVE[page]}"]`);
  }
}

for (const asset of ['styles.css', 'site.js', 'images/pack3-tent.png', 'images/ranks/rank-lion.png']) {
  if (!fs.existsSync(path.join(OUT, asset))) fail(`${asset} not copied to output`);
}

if (htmls['index.html'] && htmls['join.html'] && htmls['calendar.html']) {
  const norm = (s) => s.replaceAll('index.html#', '#');
  const base = norm(footerOf(htmls['index.html']));
  for (const page of ['join.html', 'calendar.html']) {
    if (norm(footerOf(htmls[page])) !== base) fail(`${page} footer differs from index (beyond the index.html# prefix)`);
  }
}

if (process.exitCode) {
  console.error('\nsmoke test failed');
} else {
  console.log(`ok — 3 pages, shared header/footer/site.js, one active nav each, assets copied`);
}
