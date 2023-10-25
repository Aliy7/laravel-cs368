import { defineConfig } from 'vite';

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    outDir: 'public',
  },
  server: {
    proxy: {
      '/': 'http://localhost',
    },
  },
});
