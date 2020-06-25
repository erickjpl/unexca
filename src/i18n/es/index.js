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
		dashboard: 'Dashboard',
		login: 'Iniciar Sesión',
	  	register: 'Registrarse',

		// Captions
		caption: {
			home: 'Página principal',
			about: 'Información sobre nosotros',
			dashboard: 'Panel de administración',
			login: 'Entrar en el sistema',
			register: 'Registrarse en el sistema',
		}
  	},

	field: {
		email: 'Correo electrónico',
		password: 'Contraseña',
		remember_me: 'Recuérdame',
		confirmation: 'Confirmar contraseña',
		subject: 'Llena',
		drinks: 'Bebidas',

		hint: {
			email: 'Ingrese su correo electrónico',
			password: 'Ingrese su contraseña',
			confirmation: 'Favor confirmar su contraseña',
		}
	},

	button: {
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
	},

	validation: es.messages
}
