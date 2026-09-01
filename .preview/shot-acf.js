const { chromium } = require('/nix/store/9p4gil2ka4riqdvw9ckdl5hzj8zmfz2v-playwright-core-1.54.1');
const EXEC = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';
const BASE = 'http://localhost:8081';
const OUT = '/home/jono/sync/more/troop3-designs/.preview';

(async () => {
  const browser = await chromium.launch({ executablePath: EXEC, args: ['--no-sandbox'] });
  const ctx = await browser.newContext({ viewport: { width: 1440, height: 1000 } });
  const page = await ctx.newPage();

  // front page
  await page.goto(BASE + '/', { waitUntil: 'networkidle', timeout: 30000 });
  await page.waitForTimeout(600);
  await page.screenshot({ path: `${OUT}/acf-home.png`, fullPage: true });
  console.log('shot: acf-home');

  // log in to wp-admin
  await page.goto(BASE + '/wp-login.php', { waitUntil: 'networkidle' });
  await page.fill('#user_login', 'admin');
  await page.fill('#user_pass', 'admin');
  await page.click('#wp-submit');
  await page.waitForLoadState('networkidle');

  // find Home page ID and open its editor (classic editor param to render ACF metaboxes inline)
  await page.goto(BASE + '/wp-admin/edit.php?post_type=page', { waitUntil: 'networkidle' });
  // Home is post 4
  await page.goto(BASE + '/wp-admin/post.php?post=4&action=edit', { waitUntil: 'domcontentloaded', timeout: 30000 });
  // wait for an ACF field label to appear, then let layout settle
  try { await page.waitForSelector('.acf-field', { timeout: 20000 }); } catch (e) { console.log('no .acf-field yet'); }
  await page.waitForTimeout(2500);
  // close the "welcome to block editor" modal if present
  try { await page.click('button[aria-label="Close"]', { timeout: 1500 }); } catch (e) {}
  await page.waitForTimeout(500);
  await page.screenshot({ path: `${OUT}/acf-admin-edit.png`, fullPage: true });
  console.log('shot: acf-admin-edit');

  await browser.close();
})().catch(e => { console.error(e); process.exit(1); });
