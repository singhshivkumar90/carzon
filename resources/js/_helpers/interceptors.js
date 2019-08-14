import axios from 'axios';
import store from "../store/index";

export const Interceptor = {
    request,
};

/**
 * Check the authentication while making API call
 */
function request() {
    axios.interceptors.request.use(function (config) {
        const token = store.getters['authentication/token'];
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    }, function (err) {
        return Promise.reject(err);
    });
}
