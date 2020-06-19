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

	fields: {
		email: 'Correo electrónico',
		password: 'Contraseña',
		confirmation: 'Confirmar contraseña',
		subject: 'Llena',
		drinks: 'Bebidas'
	},

	validation: es.messages
}
