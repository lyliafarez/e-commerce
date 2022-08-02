export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Client',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '@/plugins/vueLaravelPagination',
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    ['nuxt-mail', {
      message: {
        to: 'me@gmail.com',
      },
      smtp: {
        host: 'smtp.mailtrap.io',
        port: 2525,
        auth: {
          user: '15470d473476dc',
          pass: 'bbc0996c010b09'
        },
      },
    }],
    
  ],

  axios: {
    baseURL: 'http://localhost:8000/',
    credentials: true,
    headers: {
        common: {
          'Accept': 'application/json, text/plain, */*'
        },
        
    }
},

auth: {
  strategies: {
      'laravelSanctum': {
          provider: 'laravel/sanctum',
          url: 'http://localhost:8000',
          endpoints: {
              login: {
                  url: '/login'
              },
              logout: {
                  url: '/logout'
              },
              user: {
                  url: '/api/user'
              },
          },
          user: {
              property: false
          }
      },
  },
  redirect: {
      login: '/auth/login',
      logout: '/',
      home: '/dashboard',
  }
},


  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
