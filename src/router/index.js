import Vue from 'vue'
import VueRouter from 'vue-router'

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
    const record = to.matched.find(record => record.meta.auth)
    
    if (record) {
      if (!store.getters['auth/loggedIn']) {
        next({ name: 'login' })
        // router.push({ name: 'login' }).catch(err => {console.log(err)})
      } else if (isArrayOrString(record.meta.auth) && !store.getters['auth/check'](record.meta.auth)) {
        next({ name: 'dashboard.index' })
        // router.push({ name: 'dashboard.index' }).catch(err => {console.log(err)})
      }
    }

    next()
  })

  return router
}
