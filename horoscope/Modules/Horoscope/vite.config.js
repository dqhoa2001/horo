const dotenvExpand = require('dotenv-expand');
dotenvExpand(
  require('dotenv').config({ path: '../../.env' /*, debug: true*/ })
);

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  build: {
    outDir: '../../public/build-horoscope',
    emptyOutDir: true,
    manifest: true,
  },
  plugins: [
    laravel({
      publicDirectory: '../../public',
      buildDirectory: 'build-horoscope',
      input: [
        __dirname + '/Resources/assets/sass/app.scss',
        __dirname + '/Resources/assets/js/app.js',
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
      '@': path.resolve(__dirname, 'src-horoscope'),
    },
  },
});
