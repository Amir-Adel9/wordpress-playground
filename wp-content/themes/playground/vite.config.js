import { defineConfig } from 'vite';

export default defineConfig({
  root: './assets',
  base: '/',
  build: {
    outDir: '../dist',
    manifest: true,
    emptyOutDir: true,
  },
  server: {
    port: 5173,
    strictPort: true,
    hmr: {
      host: 'localhost',
    },
  },
});
