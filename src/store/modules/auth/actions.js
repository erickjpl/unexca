import { AuthService } from '../../../service/AuthService'

export async function register ({commit}, data) {
  await AuthService.register(data)
    .then( response => commit( 'SET_USER', response.data ))
    .catch( error => Promise.reject(error))
}

export async function login ({commit}, data) {
  await AuthService.login(data)
    .then( response => {
      let data = response.data.data
      let token = response.data.data.attributes.token
      commit('SET_USER', data)
      commit('profile/SET_PROFILE', data.relationships, {root: true})
      commit('SET_TOKEN', { token: token, rememberMe: data.rememberMe })
    })
    .catch( error => Promise.reject(error))
}

export async function fetch ({commit, getters}) {
  // crear un interceptor para la autorizacion
  // AuthService.defaults.headers.common['Authorization'] = getters.token;

  await AuthService.fetch()
    .then( response => commit('SET_USER', response.data.user.data))
    .catch( error => Promise.reject(error))
}

export function logout ({commit}) {
  commit('LOGOUT', null)
}

export async function verify ({commit}, token) {
  await AuthService.verify(token)
    .then( response => console.log(response))
    .catch( error => Promise.reject(error))
}
export async function passwordForgot ({commit}, data) {
  await AuthService.passwordForgot(data)
    .then( response => console.log(response))
    .catch( error => Promise.reject(error))
}

export async function passwordReset ({commit}, { token, data }) {
  await AuthService.passwordReset(token, data)
    .then( response => console.log(response))
    .catch( error => Promise.reject(error))
}
