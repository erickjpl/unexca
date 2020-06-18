import axios from 'axios'

const BASE_URL = 'http://localhost:8000/api/'

const service = axios.create({
    headers: { 'Content-Type': 'application/json' },
    baseURL: BASE_URL,
    timeout: 5000
})

export default service