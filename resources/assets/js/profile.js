require('./bootstrap');

window.Vue = require('vue');

import Axios from 'axios';

Vue.use(Axios);

new Vue({
    el: '#profile-page',
    components: {
        'profil-pegawai': require('./components/ProfilPegawai.vue'),
        'profil-pegawai-specific': require('./components/ProfilPegawaiSpecific.vue'),
    }

});