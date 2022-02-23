import axios from 'axios';
import store from '@/store/store';

const apiService = axios.create({
    withCredentials: true,
    baseURL: '/',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
});
apiService.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401 && window.location.pathname !== '/guest') {
            store.dispatch('logout');
            window.location = '/login';
        }

        return Promise.reject(error);
    }
);

export default {
    api: apiService,
}