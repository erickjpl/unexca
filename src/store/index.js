import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

// import example from './module-example'
import state from './default/state'
import * as getters from './default/getters'
import * as mutations from './default/mutations'
import * as actions from './default/actions'

// Modules
import auth from './modules/auth'
import profile from './modules/profile'

Vue.use(Vuex)

/* BEGIN LOAD MODULES */
/*const requireContext = require.context('./modules', true, /.*\.js$/)

const modules = requireContext.keys()
.map(file =>
  [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
)
.reduce((modules, [name, module]) => {
  if (module.namespaced === undefined) {
    module.namespaced = true
  }

  return { ...modules, [name]: module }
}, {})*/
/* END LOAD MODULES */

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    getters,
    mutations,
    actions,
    state,

    modules: {
      // example
      auth,
      profile
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEV,
    plugins: [createPersistedState()]
  })

  return Store
}
