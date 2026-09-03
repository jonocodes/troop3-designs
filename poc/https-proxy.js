// Minimal HTTPS reverse proxy so Sveltia (needs HTTPS or localhost) loads over the LAN.
// Forwards https://<host>:8443/*  ->  http://127.0.0.1:8083/*
const https = require('https');
const http = require('http');
const fs = require('fs');

const DIR = '/home/jono/.paseo/worktrees/1fk05f73/hesitant-mayfly/poc/certs';
const opts = {
  key: fs.readFileSync(DIR + '/key.pem'),
  cert: fs.readFileSync(DIR + '/cert.pem'),
};

const TARGET = { host: '127.0.0.1', port: 8083 };

https.createServer(opts, (req, res) => {
  const proxyReq = http.request(
    { host: TARGET.host, port: TARGET.port, method: req.method, path: req.url, headers: req.headers },
    (proxyRes) => {
      res.writeHead(proxyRes.statusCode, proxyRes.headers);
      proxyRes.pipe(res);
    }
  );
  proxyReq.on('error', (e) => { res.writeHead(502); res.end('proxy error: ' + e.message); });
  req.pipe(proxyReq);
}).listen(8443, '0.0.0.0', () => console.log('HTTPS proxy on :8443 -> http://127.0.0.1:8083'));
