import { ProfileService } from 'src/service/ProfileService'

export async function updateDetail ({commit}, {id, q}) {
	await ProfileService.update(`detail/${id}`, q)
        .then( response => commit( 'SET_DETAIL', response.data ))
        .catch( error => Promise.reject(error))
}