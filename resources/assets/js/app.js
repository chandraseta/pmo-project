
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueGoodTable from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTable);

if (document.getElementById('pmo-page')) {
    const pmoPage = new Vue({
        el: '#pmo-page',
        components: {
            'pmo-main-page': require('./components/PMOMainPage.vue')
        }
    });
}

if (document.getElementById('admin-page')) {
    const adminPage = new Vue({
        el: '#admin-page',
        components: {
            'admin-main-page': require('./components/AdminPage.vue')
        }
    });
}

if (document.getElementById('profile-page')) {
    const profilePage = new Vue({
        el: '#profile-page',
        data : {
            isEditProfile : false,
            isEditRiwayat : false,
            imageProfileUrl: "https://i.pinimg.com/236x/34/ba/c1/34bac13dd65ab3b81267f727e5633549--patrick-dempsey-handsome-man.jpg",
            nama : "Joko Susilo",
            tempatLahir : "Medan",
            tanggalLahir: "17 Agustus 1981",
            email: "joko.susilo@gmail.com",
            nopeg: "12340009876",
            unitKerja: "Fakultas FMIPA",
            posisi: "Kepala Bidang Kemahasiswaan",
            kompetensi: "Administrasi",
            tahunMasuk: "2010",
            tahunKeluar: "2020",
            riwayatPendidikan: [
                { tingkatPendidikan: "S1",
                    namaInstitusi: "ITB",
                    jurusan: "Teknik Sipil",
                    tahunMasuk: "2000",
                    tahunKeluar: "2005" },
                { tingkatPendidikan: "S2",
                    namaInstitusi: "ITB",
                    jurusan: "Teknik Sipil",
                    tahunMasuk: "2006",
                    tahunKeluar: "2008" }
            ],
            riwayatPekerjaan: [
                { namaInstitusi: "FTSL ITB",
                    posisi: "Tenaga Pendidik",
                    tahunMasuk: "2008",
                    tahunKeluar: "2013" },
                { namaInstitusi: "FMIPA ITB",
                    posisi: "Tenaga Pendidik",
                    tahunMasuk: "2013",
                    tahunKeluar: "2017" }
            ],
            rekomendasiTraining: [
                { namaTraining: "Emotional Training",
                    penyelenggara: "PMO",
                    bidang: "Psikologi"}
            ]

        },
        methods: {
            editProfilPegawai() {
                this.isEditProfile = true;
            },

            editRiwayatPegawai() {
                this.isEditRiwayat = true;
            },
        }

    });
}