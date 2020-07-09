import { LocalStorage } from 'quasar'
import { service } from 'boot/axios'

service.interceptors.request.use(function(config) {
    const access_token = LocalStorage.getItem('access_token');

    if(!!access_token)
      config.headers.Authorization = access_token

    return config;
}, err => Promise.reject(err))

export default class ServiceFactory {

    constructor(url) { this.url = url }

    getAll(q) {
        return service.get( this.url, { params: q } )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    get(id) {
        return service.get( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    add(data) {
        return service.post( this.url, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    update(id, data) {
        return service.put( `${this.url}/${id}`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    remove(id) {
        return service.delete( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }
}
