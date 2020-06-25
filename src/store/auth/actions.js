import { AuthService } from '../../service/AuthService'

export async function register ({commit}, data) {
  await AuthService.register(data)
    .then( response => commit( 'SET_USER', response.data ))
    .catch( error => commit( 'ERROR', error ))
}

export async function login ({commit}, data) {
  console.log( "MODULE AUTH ACTIONS", data)
  await AuthService.login(data)
    .then( response => {
      commit('SET_USER', response.data.user.data)
      commit('SET_TOKEN', { token: data.token, rememberMe: data.rememberMe })
    })
    .catch( error => commit( 'ERROR', error ))
}

export async function fetch ({commit}) {
  await AuthService.fetch()
    .then( response => commit('SET_USER', response.data.user.data))
    .catch( error => commit( 'ERROR', error ))
}

export function logout ({commit}) {
  commit('LOGOUT', null)
}

export async function verify ({commit}, token) {
  await AuthService.verify(token)
    .then( response => console.log(response))
    .catch( error => commit( 'ERROR', error ))
}
export async function passwordForgot ({commit}, data) {
  await AuthService.passwordForgot(data)
    .then( response => console.log(response))
    .catch( error => commit( 'ERROR', error ))
}

export async function passwordReset ({commit}, { token, data }) {
  await AuthService.passwordReset(token, data)
    .then( response => console.log(response))
    .catch( error => commit( 'ERROR', error ))
}
