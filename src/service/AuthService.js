import { Cookies } from 'quasar'
import { service } from '../boot/axios'

const REGISTER_USER = '/auth/register'
const LOGIN_USER = '/auth/login'
const FETCH_USER = '/auth/user'
const VERIFICATION_USER = '/auth/verify?token='
const PASSWORD_FORGOT_USER = '/auth/password/forgot'
const PASSWORD_RESET_USER = '/auth/password/reset?token='

export default class ServiceAuthFactory {

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

    fetch() {
    	const p = new Promise(function (resolve, reject) { 
	        return service.get(FETCH_USER)
	            .then(  (response)  => resolve(response) )
	            .catch( (error)     => reject(error.response) )
	    })
  		return p
    }

    verify(token) {
        return service.get(`${VERIFICATION_USER}${token}`)
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
