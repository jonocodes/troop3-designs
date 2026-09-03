const { chromium } = require('/home/jono/.paseo/worktrees/1fk05f73/hesitant-mayfly/poc/sveltia/node_modules/playwright-core');
const CHROME = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';
const OUT = '/home/jono/.paseo/worktrees/1fk05f73/hesitant-mayfly/poc/screens';

(async () => {
  const b = await chromium.launch({ executablePath: CHROME, headless: true, args: ['--no-sandbox'] });
  const p = await b.newPage({ viewport: { width: 1280, height: 900 } });
  p.setDefaultTimeout(25000);

  // --- Sveltia landing (localhost -> should offer "Work with Local Repository") ---
  await p.goto('http://localhost:8083/admin/', { waitUntil: 'load' });
  await p.waitForTimeout(4000);
  await p.screenshot({ path: OUT + '/sveltia-local-landing.png' });
  console.log('sveltia landing text present:',
    /local repository/i.test(await p.evaluate(() => document.body.innerText)));

  // --- Decap editor, populated, with new fields (full page) ---
  await p.goto('http://localhost:8083/admin/decap.html', { waitUntil: 'load' });
  await p.waitForTimeout(3000);
  const login = p.getByRole('button', { name: /login/i });
  if (await login.count()) { await login.first().click(); await p.waitForTimeout(2500); }
  const entry = p.getByText('Home Page', { exact: false });
  if (await entry.count()) { await entry.first().click(); await p.waitForTimeout(3000); }
  await p.screenshot({ path: OUT + '/decap-editor-fields.png', fullPage: true });
  console.log('decap done');

  // --- Grav editor, 3 sections (full page) ---
  await p.goto('http://localhost:8082/admin', { waitUntil: 'domcontentloaded' });
  await p.waitForTimeout(1500);
  const ins = p.locator('input[type=text],input[type=password],input:not([type])');
  await ins.nth(0).fill('admin'); await ins.nth(1).fill('Password123');
  await p.getByRole('button', { name: /sign in/i }).first().click();
  await p.waitForTimeout(4000);
  await p.goto('http://localhost:8082/admin/pages/edit/home', { waitUntil: 'domcontentloaded' });
  await p.waitForTimeout(3500);
  await p.screenshot({ path: OUT + '/grav-editor-fields.png', fullPage: true });
  console.log('grav done');

  await b.close();
})();
