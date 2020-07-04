import { SessionStorage } from 'quasar'

export function SET_USER (state, data) {
  if (data) {
    state.user = {
      id: data.id,
      email: data.attributes.email,
      nickname: data.attributes.nickname,
      roles: ['admin']
    }
  } else {
    state.user = null
  }
}

export function SET_TOKEN (state, data) {
  if (data.rememberMe) {
    SessionStorage.set('access_token', data.token, { expires: 365 })
  } else {
    SessionStorage.set('access_token', data.token)
  }
}

export function LOGOUT (state, data) {
  state.user = null
  SessionStorage.remove('access_token')
}