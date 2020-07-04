// This is just an example,
// so you can safely delete all default props below
import en from "vee-validate/dist/locale/en"

export default {
	// Menu
	menu: {
		home: 'Home',
		about: 'About us',
		login: 'Login',
		register: 'Register',

		// Captions
		caption: {
			home: 'Homepage',
			about: 'Information about us',
			login: 'Enter in the system',
			register: 'Register in the system',
		},

		dashboard: {
			home: 'Home',
			profile: 'Profile',
			logout: 'Logout'
		}
	},

	form: {
		profile: {
			title: {
				account: 'Account data',
				profile: 'Personal information',
				dni: 'V: Venezuelan, E: Foreign',
				female: 'Female',
				male: 'Male'
			}
		}
	},

	field: {
		email: 'E-mail',
		nickname: 'Username',
		password: 'Password',
		remember_me: 'Remember Me',
		password_confirmation: 'Password confirmation',

		name: 'Name',
		lastname: 'Lastname',
		dni: 'National identity document',
		phone: 'Phone',
		birthdate: 'Birthdate',
		address: 'Address',
		genre: 'Genre',

		hint: {
			email: 'Enter your e-mail',
			nickname: 'Enter your user (without space and unique)',
			password: 'Enter your password',
			password_confirmation: 'Please confirm your password',
		}
	},

	button: {
		continue: 'Continue',
		cancel: 'Cancelar',
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
		register: {
			title: 'Register',
			reigistered: 'Already registered..!',
		},		
	},

	dialog: {
		logout: {
			title: 'Logout',
			message: 'Sure you want to sign out..?'
		}
	},

	splitter: {
		profile: {
			profile: 'Profile',
			teacher: 'Teacher',
			parent: 'Parent',
			student: 'Student'
		}
	},

	message: {
		error: {
			error_401: 'Unauthorized',
			error_403: 'Forbidden',
		}
	},

	validation: en.messages
}
