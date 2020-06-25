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

	field: {
		email: 'E-mail',
		password: 'Password',
		remember_me: 'Remember Me',
		confirmation: 'Password confirmation',
		subject: 'Filled',
		drinks: 'Drinks',

		hint: {
			email: 'Enter your e-mail',
			password: 'Enter your password',
			confirmation: 'Please confirm your password',
		}
	},

	button: {
		save: 'Save',
		reset: 'Reset',
		submit: 'Submit',
		close: 'Close',
		login: 'Login',
		register: 'Register',
	},

	link: {
		password_forgot: 'Password forgot',
		created_account: 'Created an account',
	},

	card: {
		login: {
			title: 'Login',
			not_reigistered: 'Not registered..!',
		},		
	},

	validation: en.messages
}
