import { service } from '../../boot/axios'

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

    update(data) {
        return service.put( `${this.url}/${data.id}`, data )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }

    remove(id) {
        return service.delete( `${this.url}/${id}` )
            .then(  (response)  => Promise.resolve(response) )
            .catch( (error)     => Promise.reject(error.response) )
    }
}
