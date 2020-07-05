import { ProfileService } from '../../../service/ProfileService'

export async function updateDetail ({commit, rootGetters}, {id, q}) {
  	ProfileService.headers(rootGetters['auth/token'])
	await ProfileService.update(`detail/${id}`, q)
        .then( response => commit( 'SET_DETAIL', response.data ))
        .catch( error => Promise.reject(error))
}