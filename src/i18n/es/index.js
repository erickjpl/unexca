// This is just an example,
// so you can safely delete all default props below
import es from "vee-validate/dist/locale/es"

export default {
	meta:{
		login: {
			title: 'Iniciar Sesión',
			tag: {
				description: 'Verificar las credenciales para poder acceder al sistema',
				keywords: '',
			}
		},
		register: {
			title: 'Registrar',
			tag: {
				description: 'Crear un nuevo usuario del sistema para acceder en el futuro',
				keywords: '',
			}
		}
	},

  	// Menu
  	menu: {
		home: 'Inicio',
		about: 'Sobre nosotros',
		login: 'Iniciar Sesión',
	  	register: 'Registrarse',

		// Captions
		caption: {
			home: 'Página principal',
			about: 'Información sobre nosotros',
			login: 'Entrar en el sistema',
			register: 'Registrarse en el sistema',
		},

		dashboard: {
			home: 'Inicio',
			profile: 'Perfil',
			logout: 'Cerrar sesión'
		}
  	},

	form: {
		profile: {
			title: {
				account: 'Datos de la cuenta',
				profile: 'Datos personales',
				dni: 'V: Venezolana, E: Extranjero',
				female: 'Femenino',
				male: 'Masculino'
			}
		}
	},

	field: {
		email: 'Correo electrónico',
		nickname: 'Nombre de usuario',
		password: 'Contraseña',
		remember_me: 'Recuérdame',
		roles: 'Rol',
		password_confirmation: 'Confirmar contraseña',

		id: 'Identificador',
		name: 'Nombre',
		lastname: 'Apellido',
		full_name: 'Nombre completo',
		dni: 'Cédula de identidad',
		phone: 'Teléfono',
		birthdate: 'Fecha de cumpleaños',
		address: 'Dirección',
		genre: 'Género',
		status:  'Estatus',
		type: 'Tipo',

		hint: {
			email: 'Ingrese su correo electrónico',
			nickname: 'Ingrese un usuario (sin espacio y único)',
			password: 'Ingrese su contraseña',
			password_confirmation: 'Favor confirmar su contraseña',
		}
	},

	button: {
		continue: 'Continuar',
		cancel: 'Cancelar',
		save: 'Guardar',
		reset: 'Resetear',
		submit: 'Enviar',
		close: 'Cerrar',
		login: 'Iniciar Sesión',
		register: 'Registrarse',
		resend: 'Haga clic aquí para solicitar otro.',
	},

	link: {
		password_forgot: 'Olvide contraseña',
		created_account: 'Create una cuenta',
	},

	card: {
		login: {
			title: 'Iniciar Sesión',
			not_reigistered: 'No estas registrado..!',
		},
		register: {
			title: 'Registrarse',
			reigistered: 'Estoy registrado..!',
		},	
	},

	dialog: {
		logout: {
			title: 'Cerrar Sesión',
			message: 'Seguro que desea cerrar sesión..?'
		}
	},

	splitter: {
		profile: {
			user: 	 'Cuenta',
			detail:  'Perfil',
			teacher: 'Docente',
			parent:  'Representante',
			student: 'Estudiante'
		}
	},

	message: {
		error: {
			error_401: 'No autorizado',
			error_403: 'Prohibido',
		},
		verify_email: 'Favor verifique su email..! Así podremos garantizar la comunicación.',
		resend_email: 'Si no recibiste el correo electrónico.'
	},

	validation: es.messages
}
