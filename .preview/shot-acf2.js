const { chromium } = require('/nix/store/9p4gil2ka4riqdvw9ckdl5hzj8zmfz2v-playwright-core-1.54.1');
const EXEC = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';
const BASE = 'http://localhost:8081';
const OUT = '/home/jono/sync/more/troop3-designs/.preview';

(async () => {
  const browser = await chromium.launch({ executablePath: EXEC, args: ['--no-sandbox'] });
  const ctx = await browser.newContext({ viewport: { width: 1440, height: 1000 } });
  const page = await ctx.newPage();
  await page.goto(BASE + '/wp-login.php', { waitUntil: 'networkidle' });
  await page.fill('#user_login', 'admin');
  await page.fill('#user_pass', 'admin');
  await page.click('#wp-submit');
  await page.waitForLoadState('networkidle');

  await page.goto(BASE + '/wp-admin/post.php?post=4&action=edit', { waitUntil: 'domcontentloaded' });
  await page.waitForTimeout(3000);
  try { await page.click('button[aria-label="Close"]', { timeout: 1500 }); } catch (e) {}

  // Expand the "Meta Boxes" drawer at the bottom of the block editor
  try {
    const btn = page.locator('.edit-post-meta-boxes-main__presenter, button:has-text("Meta Boxes")').first();
    await btn.click({ timeout: 3000 });
  } catch (e) { console.log('meta box toggle not clickable:', e.message); }
  await page.waitForTimeout(1500);

  // Scroll the ACF fields into view and screenshot full page
  try { await page.locator('.acf-field').first().scrollIntoViewIfNeeded({ timeout: 3000 }); } catch (e) {}
  await page.waitForTimeout(800);
  const n = await page.locator('.acf-field').count();
  console.log('acf-field count on page:', n);
  await page.screenshot({ path: `${OUT}/acf-admin-fields.png`, fullPage: true });
  console.log('shot: acf-admin-fields');
  await browser.close();
})().catch(e => { console.error(e); process.exit(1); });
