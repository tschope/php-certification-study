// https://nuxt.com/docs/api/configuration/nuxt-config
const path = require('path');
export default defineNuxtConfig({
    app: {
      head: {
          title: process.env.APP_NAME || 'PHP Certification Study',
          charset: 'utf-8',
          viewport: 'width=device-width, initial-scale=1',
          meta: [
              { name: 'theme-color', content: '#ffffff' },
              { name: 'description', content: process.env.APP_DESCRIPTION || 'Test your PHP knowledge with our comprehensive quiz system' },
              { name: 'ogDescription', content: process.env.APP_DESCRIPTION || 'Test your PHP knowledge with our comprehensive quiz system' },
              { name: 'ogTitle', content: process.env.APP_NAME || 'PHP Certification Study' },
              { name: 'ogImage', content: '/assets/images/logo.png' },
              { name: 'ogUrl', content: process.env.APP_URL || 'https://localhost:3000' },
              { name: 'ogType', content: 'website' },
              { name: 'twitter:card', content: 'summary_large_image' },
              { property: 'twitter:domain', content: process.env.APP_DOMAIN || 'localhost:3000' },
              { property: 'twitter:url', content: process.env.APP_URL || 'https://localhost:3000' },
              { name: 'twitter:title', content: process.env.APP_NAME || 'PHP Certification Study' },
              { name: 'twitter:description', content: process.env.APP_DESCRIPTION || 'Test your PHP knowledge with our comprehensive quiz system' },
              { name: 'twitter:image', content: '/assets/images/logo.png' },
          ],
      }
    },

    modules: ['nuxt-gtag', '@nuxtjs/seo', '@nuxtjs/sitemap', '@pinia/nuxt'],

    gtag: {
        enabled: process.env.NODE_ENV === 'production',
        id: process.env.NUXT_PUBLIC_GTAG_ID || 'G-xxxxxxxxx', // Valor padrão para fallback
    },

    compatibilityDate: '2024-11-01',
    devtools: { enabled: true },

    // Ativa o modo SSR
    ssr: true,

    nitro: {
      preset: 'node-server', // Gera uma aplicação pronta para Node.js
      devProxy: {
        '/api': {
          target: 'https://php-certification-study.localhost.ddev.site/api',
          changeOrigin: true,
          secure: false
        }
      }
    },

    css: ['~/assets/css/main.css'],

    postcss: {
      plugins: {
          tailwindcss: {},
          autoprefixer: {},
      },
    },

    runtimeConfig: {
      public: {
          apiBase: process.env.API_BASE_URL || '/api',
      },
    },

    site: {
        url: process.env.APP_URL || 'https://localhost:3000',
        name: process.env.APP_NAME || 'PHP Certification Study',
        description: process.env.APP_DESCRIPTION || 'Test your PHP knowledge with our comprehensive quiz system',
        defaultLocale: 'en',
    }
})
