export function SET_DETAIL ( state, data ) {
    let detail = data.data.attributes

    state.profile.detail = {
        name: detail.name,
        lastname: detail.lastname,
        full_name: detail.full_name,
        phone: (detail.phone !== null) ? detail.phone : null,
        dni: (detail.dni !== null) ? detail.dni : null,
        genre: detail.genre,
        birthdate: (detail.birthdate !== null) ? detail.birthdate : null,
        address: (detail.address !== null) ? detail.address : null
    }
}

export function SET_PROFILE ( state, data ) {
	let profile = {}

	if (data) {
        if (data.detail[0] != null) {
            let detail = data.detail[0].attributes

            profile = {
            	detail: {
            		id: detail.id,
            		name: detail.name,
            		lastname: detail.lastname,
                    full_name: detail.full_name,
            		phone: (detail.phone !== null) ? detail.phone : null,
            		dni: (detail.dni !== null) ? detail.dni : null,
            		genre: detail.genre,
            		birthdate: (detail.birthdate !== null) ? detail.birthdate : null,
            		address: (detail.address !== null) ? detail.address : null
            	},
            	image: {
            		path: data.image[0].attributes.path
            	}
            }
        }

        if (data.teacher[0] != null) {
            profile.teacher = {
                status: data.teacher[0].attributes.status,
                speciality: data.teacher[0].attributes.speciality
            }
        }
        
        if (data.student[0] != null) {
            profile.student = {
                status: data.student[0].attributes.status,
                type: data.student[0].attributes.type
            }
        }
        
        if (data.parent[0] != null)
            profile.parent = { family_relationship: data.parent[0].attributes.family_relationship }

        state.profile = profile
    } else {
        state.profile = null
    }
}