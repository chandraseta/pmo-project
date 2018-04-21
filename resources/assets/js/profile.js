require('./bootstrap');

window.Vue = require('vue');

import Axios from 'axios';

Vue.use(Axios);

new Vue({
    el: '#profile-page',
    components: {
        'profil-pegawai': require('./components/ProfilPegawai.vue'),
    },
    data: {
        isEditKepegawaian: false,
        isEditProfile: false,
        isEditRiwayat: false,
        cachedUser: null,
        cachedDataKepegawaian: null,
        cachedRiwayatPendidikan: null,
        cachedRiwayatPekerjaan: null,
        user: {
            imageProfileUrl: "https://i.pinimg.com/236x/34/ba/c1/34bac13dd65ab3b81267f727e5633549--patrick-dempsey-handsome-man.jpg",
            nama: "Joko Susilo",
            tempatLahir: "Medan",
            tanggalLahir: "17 Agustus 1981",
            email: "joko.susilo@gmail.com",
            nopeg: "12340009876",
            unitKerja: "Fakultas FMIPA",
            posisi: "Kepala Bidang Kemahasiswaan",
            kompetensi: "Administrasi",
            tahunMasuk: "2010",
            tahunKeluar: "2020"
        },
        dataKepegawaian: [
            {
                unitKerja: "Fakultas FMIPA",
                posisi: "Tenaga Pendidik",
                kompetensi: "Teknikal",
                tahunMasuk: "2013",
                tahunKeluar: "2017"
            }
        ],
        riwayatPendidikan: [
            {
                tingkatPendidikan: "S1",
                namaInstitusi: "ITB",
                jurusan: "Teknik Sipil",
                tahunMasuk: "2000",
                tahunKeluar: "2005"
            },
            {
                tingkatPendidikan: "S2",
                namaInstitusi: "ITB",
                jurusan: "Teknik Sipil",
                tahunMasuk: "2006",
                tahunKeluar: "2008"
            }
        ],
        riwayatPekerjaan: [
            {
                namaInstitusi: "PT TIMBUL TENGGELAM",
                posisi: "Engineer",
                tahunMasuk: "2008",
                tahunKeluar: "2013"
            },
            {
                namaInstitusi: "FMIPA ITB",
                posisi: "Tenaga Pendidik",
                tahunMasuk: "2013",
                tahunKeluar: "2017"
            }
        ],
        rekomendasiTraining: [
            {
                namaTraining: "Emotional Training",
                penyelenggara: "PMO",
                bidang: "Psikologi"
            }
        ]

    },
    mounted() {

        this.cachedUser = Object.assign({}, this.user);
        this.cachedDataKepegawaian = Object.assign({}, this.dataKepegawaian);
        this.cachedRiwayatPendidikan = Object.assign({}, this.riwayatPendidikan);
        this.cachedRiwayatPekerjaan = Object.assign({}, this.riwayatPekerjaan);
    },
    methods: {
        editProfilPegawai() {
            this.isEditProfile = true;
        },

        editDataKepegawaian() {
            this.isEditKepegawaian = true;
        },

        editRiwayatPegawai() {
            this.isEditRiwayat = true;
        },

        saveProfilPegawai() {
            this.cachedUser = Object.assign({}, this.user);
            this.isEditProfile = false;

            axios.patch('/api/pegawai/4', {
                name: this.user.nama,
                email: this.user.email,
                password: '1234',
                nip: this.user.nopeg
            })
                .then(function (response) {
                    alert(response);
                })
                .catch(function (error) {
                    alert(error);
                });

        },

        saveDataKepegawaian() {
            this.cachedDataKepegawaian = Object.assign({}, this.dataKepegawaian);
            this.isEditKepegawaian = false;
        },

        saveRiwayatPegawai() {
            this.cachedRiwayatPendidikan = Object.assign({}, this.riwayatPendidikan);
            this.cachedRiwayatPekerjaan = Object.assign({}, this.riwayatPekerjaan);
            this.isEditRiwayat = false;
        },

        cancelProfilPegawai() {
            this.user = Object.assign({}, this.cachedUser);
            this.isEditProfile = false;
        },

        cancelDataKepegawaian() {
            this.dataKepegawaian = Object.assign({}, this.cachedDataKepegawaian);
            this.isEditKepegawaian = false;
        },

        cancelRiwayatPegawai() {
            this.riwayatPendidikan = Object.assign({}, this.cachedRiwayatPendidikan);
            this.riwayatPekerjaan = Object.assign({}, this.cachedRiwayatPekerjaan);
            this.isEditRiwayat = false;
        },
    }

});