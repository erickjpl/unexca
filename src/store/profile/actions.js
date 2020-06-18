import { ProfileService } from '../../service/ProfileService'

export async function getAllUsers ({commit}, q) {
	await ProfileService.getAll(q)
        .then( response => {
        	console.log( response )
            commit( 'ALL_USER', response.data )
        })
        .catch( error => commit( 'ERROR', error ))
}