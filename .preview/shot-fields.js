const { chromium } = require('/nix/store/9p4gil2ka4riqdvw9ckdl5hzj8zmfz2v-playwright-core-1.54.1');
const EXEC = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';
const BASE = 'http://localhost:8081';
const OUT = '/home/jono/sync/more/troop3-designs/.preview';
(async () => {
  const b = await chromium.launch({ executablePath: EXEC, args: ['--no-sandbox'] });
  const c = await b.newContext({ viewport: { width: 1200, height: 1000 } });
  const p = await c.newPage();
  await p.goto(BASE + '/wp-login.php', { waitUntil: 'networkidle' });
  await p.fill('#user_login', 'admin'); await p.fill('#user_pass', 'admin');
  await p.click('#wp-submit'); await p.waitForLoadState('networkidle');
  await p.goto(BASE + '/wp-admin/post.php?post=4&action=edit', { waitUntil: 'domcontentloaded' });
  await p.waitForTimeout(3000);
  // scroll to the first ACF group (Hero) and screenshot just that area
  try { await p.locator('.acf-field-group, .postbox').first().scrollIntoViewIfNeeded(); } catch(e){}
  await p.waitForTimeout(500);
  await p.screenshot({ path: `${OUT}/fields-hero.png` });
  console.log('shot: fields-hero');
  await b.close();
})().catch(e => { console.error(e); process.exit(1); });
