const { chromium } = require('/nix/store/9p4gil2ka4riqdvw9ckdl5hzj8zmfz2v-playwright-core-1.54.1');
const EXEC = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';

(async () => {
  const browser = await chromium.launch({ executablePath: EXEC, args: ['--no-sandbox'] });
  const pages = [
    ['http://localhost:8080/', 'home', 1440, 900],
    ['http://localhost:8080/about/', 'about', 1440, 900],
    ['http://localhost:8080/calendar/', 'calendar', 1440, 900],
    ['http://localhost:8080/', 'home-mobile', 390, 844],
  ];
  for (const [url, name, w, h] of pages) {
    const ctx = await browser.newContext({ viewport: { width: w, height: h }, deviceScaleFactor: 1 });
    const page = await ctx.newPage();
    await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
    await page.waitForTimeout(800);
    await page.screenshot({ path: `/home/jono/sync/more/troop3-designs/.preview/${name}.png`, fullPage: true });
    console.log('shot:', name);
    await ctx.close();
  }
  await browser.close();
})().catch(e => { console.error(e); process.exit(1); });
