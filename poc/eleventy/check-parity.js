#!/usr/bin/env node
// Fails if _site/ drifts from raw-html/ beyond two documented normalizations:
//   1. built mobile menu may add the Join link (one line, onclick variant)
//   2. built footer may include index's 1935/1936 HTML comment
const fs = require('fs');
const path = require('path');

const rawDir = path.join(__dirname, '../../raw-html');
const outDir = path.join(__dirname, '_site');
const PAGES = ['index.html', 'join.html', 'calendar.html'];

const between = (html, from, to) => {
  const a = html.indexOf(from);
  const b = html.indexOf(to, a);
  if (a < 0 || b < 0) throw new Error(`missing markers: ${from} / ${to}`);
  return html.slice(a, b);
};

const lines = (s) => s.split('\n').map((l) => l.trimEnd()).filter((l) => l !== '');
const dropJoinItem = (ls) => ls.filter((l) => l.trim() !== '<a href="join.html" onclick="toggleMenu()">Join</a>');
const dropComment = (s) => s.replace(/\n?\s*<!-- \*\*The best circumstantial[\s\S]*?-->/, '');

let failures = 0;
const check = (file, label, ok) => {
  if (!ok) failures++;
  console.log(`${ok ? 'ok  ' : 'FAIL'} ${file} ${label}`);
};

for (const file of PAGES) {
  const raw = fs.readFileSync(path.join(rawDir, file), 'utf8');
  const built = fs.readFileSync(path.join(outDir, file), 'utf8');
  const marker = raw.includes('<!-- Page Hero -->') ? '<!-- Page Hero -->' : '<!-- Hero -->';

  check(file, 'body', between(raw, marker, '<!-- Footer -->').trimEnd() === between(built, marker, '<!-- Footer -->').trimEnd());

  const footerRaw = lines(dropComment(between(raw, '<!-- Footer -->', '</footer>')));
  const footerBuilt = lines(dropComment(between(built, '<!-- Footer -->', '</footer>')));
  check(file, 'footer', JSON.stringify(footerRaw) === JSON.stringify(footerBuilt));

  const headerRaw = dropJoinItem(lines(between(raw, '<!-- Header -->', marker)));
  const headerBuilt = dropJoinItem(lines(between(built, '<!-- Header -->', marker)));
  check(file, 'header', JSON.stringify(headerRaw) === JSON.stringify(headerBuilt));
}

if (failures) {
  console.error(`\n${failures} parity failure(s) — run \`npm run build\` first?`);
  process.exit(1);
}
console.log('\nparity with raw-html/ holds');
