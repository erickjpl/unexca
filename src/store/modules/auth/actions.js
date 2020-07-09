import { AuthService } from 'src/service/AuthService'

export async function register ({commit}, data) {
  await AuthService.register(data)
    .then( response => {
      let token = response.data.data.attributes.token
      commit('SET_USER', response.data.data)
      commit('SET_TOKEN', { token: token, rememberMe: '' })
    })
    .catch( error => Promise.reject(error))
}

export async function login ({commit}, data) {
  await AuthService.login(data)
    .then( response => {
      let data = response.data.data
      let token = response.data.data.attributes.token
      commit('SET_USER', data)
      commit('profile/SET_PROFILE', data.relationships, {root: true})
      commit('SET_TOKEN', { token: token, rememberMe: null })
    })
    .catch( error => console.log("HEY",error))
}

export async function updateAccount ({commit}, {id, q}) {
  await AuthService.user(id, q)
    .then( response => commit('SET_USER', response.data.data))
    .catch( error => Promise.reject(error))
}

export async function logout ({commit}) {
  await AuthService.logout()
    .then( response => commit('LOGOUT', null) )
    .catch( error => {
      if (error.data.code === "TKI" || error.data.code === "TKE" || error.data.code === "TKN") 
        commit('LOGOUT', null)

      return Promise.reject(error)
    })
}

export async function verify ({commit}, data) {
  await AuthService.verify(data)
    .then( response => commit('VERIFY', response.data.data))
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
