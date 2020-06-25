import { Cookies } from 'quasar'

export function SET_USER (state, data) {
  if (data) {
    state.user = {
      id: data.id,
      email: data.attributes.email,
      nickname: data.attributes.name,
      roles: data.attributes.roleNames
    }
  } else {
    state.user = null
  }
}

export function SET_TOKEN (state, data) {
  if (data.rememberMe) {
    Cookies.set('authorization_token', data.token, { expires: 365 })
  } else {
    Cookies.set('authorization_token', data.token)
  }
}

export function LOGOUT (state, data) {
  state.user = null
  Cookies.remove('authorization_token')
}

export function ERROR (state, data) {
  state.error = {
    status: data.response.status,
    statusText: data.response.statusText,
    message: data.response.message,
    file: data.response.data.file,
    line: data.response.data.line
  }
}