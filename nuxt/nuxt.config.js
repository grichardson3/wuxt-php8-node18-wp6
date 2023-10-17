const axios = require('axios')
const pkg = require('./package')

module.exports = {
  env: {
    WUXT_PORT_BACKEND: process.env.WUXT_PORT_BACKEND || '3080'
  },

  head: {
    title: pkg.name,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: pkg.description }
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }]
  },

  loading: { color: '#333' },

  css: [
    '@/assets/styles/main.scss',
    '@/assets/styles/normalize.scss'
  ],

  plugins: [
    { src: '~/plugins/wp-api-docker-connector', ssr: false }
  ],

  modules: [
    '@nuxtjs/axios', // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/pwa',
    '~/modules/static/',
    [
      '~/modules/wp-api/index',
      {
        endpoint: 'http://' + (process.env.WUXT_WP_CONTAINER ? process.env.WUXT_WP_CONTAINER : 'wp.wuxt') + ':80/wp-json/'
        // endpoint: 'http://localhost/wuxt-website/wp-json/'
      }
    ]
  ],

  build: {
    /*
     ** You can extend webpack config here
     */
    // extend(config, ctx) {
    //   // Run ESLint on save
    //   if (ctx.isDev && ctx.isClient) {
    //     config.module.rules.push({
    //       enforce: 'pre',
    //       test: /\.(js|vue)$/,
    //       loader: 'eslint-loader',
    //       exclude: /(node_modules)/
    //     })
    //   }
    // }
  },

  generate: {
    fallback: '404.vue',
    routes: [() => {
      return axios.get('http://' + (process.env.WUXT_WP_CONTAINER ? process.env.WUXT_WP_CONTAINER : 'wp.wuxt') + ':80/wp-json/wuxt/v1/generate',)
      .then(({ data }) => {
        return data;
      });
    }]
  }
}
