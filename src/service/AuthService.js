import { LocalStorage } from 'quasar'
import { service } from 'boot/axios'

const FETCH_USER = '/profile/user'
const REGISTER_USER = '/auth/register'
const LOGIN_USER = '/auth/login'
const REFRESH_TOKEN = '/auth/refresh'
const RESEND_EMAIL = '/auth/email/resend'
const LOGOUT_USER = '/auth/logout'
const VERIFICATION_USER = '/auth/email/verify'
const PASSWORD_FORGOT_USER = '/auth/password/forgot'
const PASSWORD_RESET_USER = '/auth/password/reset?token='

service.interceptors.request.use(function(config) {
    const access_token = LocalStorage.getItem('access_token');

    if(!! access_token)
      config.headers.Authorization = access_token

    return config;
}, err => Promise.reject(err))

export default class ServiceAuthFactory 
{
    register(data) {
        return service.post(REGISTER_USER, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    login(data) {
        const p = new Promise(function (resolve, reject) { 
            return service.post(LOGIN_USER, data)
                .then(  (response)  => resolve(response) )
                .catch( (error)     => reject(error.response) )
        })
        return p
    }

    refresh() {
        return service.post(REFRESH_TOKEN)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    logout() {
        const p = new Promise(function (resolve, reject) { 
            return service.post(LOGOUT_USER)
                .then(  (response)  => resolve(response) )
                .catch( (error)     => reject(error.response) )
        })
        return p
    }

    user(id, data) {
    	const p = new Promise(function (resolve, reject) { 
	        return service.put(`${FETCH_USER}/${id}`, data)
	            .then(  (response)  => resolve(response) )
	            .catch( (error)     => reject(error.response) )
	    })
  		return p
    }

    verify(data) {
        return service.get(`${VERIFICATION_USER}/${data.id}/${data.hash}?expires=${data.expires}&signature=${data.signature}`)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    resend(data) {
        return service.post(RESEND_EMAIL)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    passwordForgot(data) {
        return service.post(PASSWORD_FORGOT_USER, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    passwordReset(token, data) {
        return service.post(`${PASSWORD_RESET_USER}${token}`, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }
}

export const AuthService = new ServiceAuthFactory();
