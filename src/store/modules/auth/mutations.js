import { LocalStorage } from 'quasar'

export function SET_USER (state, data) {
  if (data) {
    state.user = {
      id: data.id,
      email: data.attributes.email,
      email_verified_at: data.attributes.email_verified_at,
      nickname: data.attributes.nickname,
      expires_in: data.attributes.expires_in,
      roles: ['admin']
    }
  } else {
    state.user = null
  }
}

export function SET_TOKEN (state, data) {
  if (data.rememberMe) {
    LocalStorage.set('access_token', data.token, { expires: 365 })
  } else {
    LocalStorage.set('access_token', data.token)
  }
}

export function LOGOUT (state, data) {
  state.user = null
  state.verify = null
  LocalStorage.remove('access_token')
}

export function VERIFY (state, data) {
  state.user.email_verified_at = data.attributes.email_verified_at
}