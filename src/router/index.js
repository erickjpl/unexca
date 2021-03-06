import Vue from 'vue'
import VueRouter from 'vue-router'
import { LocalStorage } from 'quasar'

import routes from './routes'

Vue.use(VueRouter)

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Router instance.
 */

 /* eslint-enable no-use-before-define */
function isArrayOrString (variable) {
  if (typeof variable === typeof [] || typeof variable === typeof '') {
    return true
  }
  return false
}

export default function ({ store }/* { store, ssrContext } */) {
  const router = new VueRouter({
    scrollBehavior: () => ({ x: 0, y: 0 }),
    routes,

    // Leave these as they are and change in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  })

  router.beforeEach((to, from, next) => {
    const user = store.getters['auth/user']
    const roles = to.matched.some(route => {
      return route.meta.role && store.getters['auth/check'](route.meta.role)
    })
    if(to.matched.some(record => record.meta.auth)) {
      if (! LocalStorage.getItem('access_token')) {
        next({name: 'login', params: { nextUrl: to.fullPath }})
      } else {
        if(to.matched.some(record => record.meta.role)) {
          if(roles){
            next()
          } else {
            next({ name: from.name})
          }
        } else {
          next()
        }
      }
    } else if(to.matched.some(record => record.meta.guest)) {
      if(! LocalStorage.getItem('access_token')){
        next()
      } else {
        next({ name: 'dashboard.index'})
      }
    } else {
      next()
    }
  })

  return router
}
