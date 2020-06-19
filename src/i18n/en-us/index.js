// This is just an example,
// so you can safely delete all default props below
import en from "vee-validate/dist/locale/en"

export default {
	failed: 'Action failed',
	success: 'Action was successful',

	// Menu
	menu: {
		home: 'Home',
		about: 'About us',
		dashboard: 'Dashboard',
		login: 'Login',
		register: 'Register',

		// Captions
		caption: {
			home: 'Homepage',
			about: 'Information about us',
			dashboard: 'Administration panel',
			login: 'Enter in the system',
			register: 'Register in the system',
		}
	},

	fields: {
		email: 'E-mail',
		password: 'Password',
		confirmation: 'Password confirmation',
		subject: 'Filled',
		drinks: 'Drinks'
	},

	validation: en.messages
}
