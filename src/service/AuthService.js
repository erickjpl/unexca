import { Cookies } from 'quasar'
import { service } from '../boot/axios'

const FETCH_USER = '/profile/user'
const REGISTER_USER = '/auth/register'
const LOGIN_USER = '/auth/login'
const LOGOUT_USER = '/auth/logout'
const VERIFICATION_USER = '/auth/verify?token='
const PASSWORD_FORGOT_USER = '/auth/password/forgot'
const PASSWORD_RESET_USER = '/auth/password/reset?token='

export default class ServiceAuthFactory 
{
    headers(token) { service.defaults.headers.common['Authorization'] = token }

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
