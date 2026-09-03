// Screenshot / automation driver for the two POCs.
// Usage: node shot.js <phase>
const { chromium } = require('/home/jono/.paseo/worktrees/1fk05f73/hesitant-mayfly/poc/sveltia/node_modules/playwright-core');
const fs = require('fs');
const path = require('path');

const CHROME = '/nix/store/8gsyn6xgbqwccdz93f3kqc9glmx37ab7-playwright-chromium/chrome-linux64/chrome';
const OUT = '/home/jono/.paseo/worktrees/1fk05f73/hesitant-mayfly/poc/screens';
fs.mkdirSync(OUT, { recursive: true });

const phase = process.argv[2] || 'basics';

async function shot(page, name) {
  const p = path.join(OUT, name + '.png');
  await page.screenshot({ path: p, fullPage: false });
  console.log('  shot:', p);
}

(async () => {
  const browser = await chromium.launch({
    executablePath: CHROME,
    headless: true,
    args: ['--no-sandbox', '--disable-dev-shm-usage'],
  });
  const page = await browser.newPage({ viewport: { width: 1280, height: 900 } });
  page.setDefaultTimeout(20000);

  try {
    if (phase === 'basics') {
      // Grav front page
      await page.goto('http://localhost:8082/home', { waitUntil: 'networkidle' });
      await page.waitForTimeout(600);
      await shot(page, 'grav-home');

      // Sveltia/static front page
      await page.goto('http://localhost:8083/', { waitUntil: 'networkidle' });
      await page.waitForTimeout(600);
      await shot(page, 'static-home');

      // Sveltia admin landing (its own UI)
      await page.goto('http://localhost:8083/admin/', { waitUntil: 'load' });
      await page.waitForTimeout(3500);
      await shot(page, 'sveltia-admin-landing');

      // Decap admin landing
      await page.goto('http://localhost:8083/admin/decap.html', { waitUntil: 'load' });
      await page.waitForTimeout(3500);
      await shot(page, 'decap-admin-landing');
    }

    if (phase === 'sveltia') {
      // Sveltia editing UI via test-repo backend
      await page.goto('http://localhost:8083/admin/', { waitUntil: 'load' });
      await page.waitForTimeout(3000);
      // test-repo shows a "Work with Test Repository" button
      const signIn = page.getByRole('button', { name: /test repository|work with|sign in|login/i });
      if (await signIn.count()) { await signIn.first().click(); await page.waitForTimeout(3000); }
      await shot(page, 'sveltia-collections');
      // open Pages collection then the Home Page entry
      const pages = page.getByText('Pages', { exact: false });
      if (await pages.count()) { await pages.first().click(); await page.waitForTimeout(1500); }
      const entry = page.getByText('Home Page', { exact: false });
      if (await entry.count()) { await entry.first().click(); await page.waitForTimeout(3000); }
      await shot(page, 'sveltia-editor');
    }

    if (phase === 'decap') {
      await page.goto('http://localhost:8083/admin/decap.html', { waitUntil: 'load' });
      await page.waitForTimeout(3000);
      const login = page.getByRole('button', { name: /login/i });
      if (await login.count()) { await login.first().click(); await page.waitForTimeout(2500); }
      await shot(page, 'decap-collections');
      const entry = page.getByText('Home Page', { exact: false });
      if (await entry.count()) { await entry.first().click(); await page.waitForTimeout(3000); }
      await shot(page, 'decap-editor');

      // Try to edit the Hero Title and publish
      try {
        const title = page.getByLabel('Hero Title');
        if (await title.count()) {
          await title.first().click();
          await title.first().fill('Albany Cub Scouts Pack 3 — Now Enrolling!');
          await page.waitForTimeout(500);
          await shot(page, 'decap-editor-edited');
          // Publish dropdown
          const pub = page.getByRole('button', { name: /^publish$/i });
          if (await pub.count()) {
            await pub.first().click();
            await page.waitForTimeout(600);
            const pubNow = page.getByText(/publish now/i);
            if (await pubNow.count()) { await pubNow.first().click(); }
            await page.waitForTimeout(3000);
            await shot(page, 'decap-after-publish');
            console.log('PUBLISHED edit via Decap');
          } else { console.log('no publish button found'); }
        } else { console.log('Hero Title field not found'); }
      } catch (e) { console.log('edit step error:', e.message); }
    }

    if (phase === 'grav') {
      await page.goto('http://localhost:8082/admin', { waitUntil: 'networkidle' });
      await page.waitForTimeout(1500);
      // login (fields are the only two textboxes on the page)
      const inputs = page.locator('input[type="text"], input[type="password"], input:not([type])');
      await inputs.nth(0).fill('admin');
      await inputs.nth(1).fill('Password123');
      await shot(page, 'grav-login');
      await page.getByRole('button', { name: /sign in/i }).first().click();
      await page.waitForTimeout(4000);
      await shot(page, 'grav-dashboard');
      // Pages list
      await page.getByRole('link', { name: /^Pages/ }).first().click();
      await page.waitForTimeout(2500);
      await shot(page, 'grav-pages-list');
      // open the Home page editor
      const home = page.getByRole('link', { name: /^Home$/ });
      if (await home.count()) { await home.first().click(); }
      else { await page.getByText('Home', { exact: true }).first().click(); }
      await page.waitForTimeout(3000);
      // click the "Hero Fields" tab if present
      const tab = page.getByText('Hero Fields', { exact: false });
      if (await tab.count()) { await tab.first().click(); await page.waitForTimeout(1200); }
      await shot(page, 'grav-editor');
    }

    console.log('phase done:', phase);
  } catch (e) {
    console.error('ERROR in phase', phase, ':', e.message);
  } finally {
    await browser.close();
  }
})();
