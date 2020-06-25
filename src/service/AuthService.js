import { Cookies } from 'quasar'
import { service } from '../boot/axios'

const REGISTER_USER = '/auth/register'
const LOGIN_USER = '/auth/login'
const FETCH_USER = '/auth/user'
const VERIFICATION_USER = '/auth/verify?token='
const PASSWORD_FORGOT_USER = '/auth/password/forgot'
const PASSWORD_RESET_USER = '/auth/password/reset?token='

export default class ServiceAuthFactory {

    constructor() { 
        service.defaults.headers.common['Authorization'] = 'Bearer ' + Cookies.get('authorization_token') 
    }

    register(data) {
        return service.post(REGISTER_USER, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error) )
    }

    login(data) {
        return service.post(LOGIN_USER, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error) )
    }

    fetch() {
    	const p = new Promise(function (resolve, reject) { 
	        return service.get(FETCH_USER)
	            .then(  (response)  => resolve(response) )
	            .catch( (error)     => reject(error) )
	    })
  		return p
    }

    verify(token) {
        return service.get(`${VERIFICATION_USER}${token}`)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error) )
    }

    passwordForgot(data) {
        return service.post(PASSWORD_FORGOT_USER, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error) )
    }

    passwordReset(token, data) {
        return service.post(`${PASSWORD_RESET_USER}${token}`, data)
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error) )
    }
}

export const AuthService = new ServiceAuthFactory();
