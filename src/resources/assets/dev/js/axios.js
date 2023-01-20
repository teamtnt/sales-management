import axios from 'axios';

const Axios = axios.create();

Axios.defaults.headers.common['X-CSRF-TOKEN'] = window.App.config.csrfToken;
Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios = Axios;

export default Axios;
