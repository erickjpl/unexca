import axios from 'axios'

const BASE_URL = 'http://localhost:8000/api/'

const service = axios.create({
  baseURL: BASE_URL,
  headers: { 'Content-Type': 'application/json' },
})

export default ({ Vue }) => {
  Vue.prototype.$axios = service
}

export { service }