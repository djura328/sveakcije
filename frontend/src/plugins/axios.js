import axios from 'axios'
import cfg from '../config'

let instance = axios.create({
    baseURL: cfg.URL
});

export default instance