import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Toastify from 'toastify-js';
window.Toastify = Toastify;
