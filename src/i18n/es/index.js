// This is just an example,
// so you can safely delete all default props below
import es from "vee-validate/dist/locale/es"

export default {
	failed: 'Accion fallida',
	success: 'La acción fue exitosa',

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
			logout: 'Cerrar sesión'
		}
  	},

	field: {
		email: 'Correo electrónico',
		nickname: 'Nombre de usuario',
		password: 'Contraseña',
		remember_me: 'Recuérdame',
		password_confirmation: 'Confirmar contraseña',

		hint: {
			email: 'Ingrese su correo electrónico',
			nickname: 'Ingrese un usuario (sin espacio y único)',
			password: 'Ingrese su contraseña',
			password_confirmation: 'Favor confirmar su contraseña',
		}
	},

	button: {
		continue: 'Continuar',
		cancel: 'Cancel',
		save: 'Guardar',
		reset: 'Resetear',
		submit: 'Enviar',
		close: 'Cerrar',
		login: 'Iniciar Sesión',
		register: 'Registrarse',
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

	message: {
		error: {
			error_401: 'No autorizado',
			error_403: 'Prohibido',
		}
	},

	validation: es.messages
}
