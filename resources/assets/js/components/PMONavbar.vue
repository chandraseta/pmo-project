<template>
    <nav class="navbar navbar-expand-md bg-primary navbar-dark">
        <a class="navbar-brand font-weight-bold" href="#">UPT PMO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item"
                    v-for="item in navItems"
                    :class="{active: item.isActive}"
                    :id="item.name">
                    <a class="nav-link"
                       :href="item.link"
                       @click="navigateTo(item.name)">
                        {{ item.label }}
                    </a>
                </li>
            </ul>
            <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
                <a href="/pages" class="btn navbar-btn btn-primary ml-2 text-white">
                    Kembali
                </a>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                username: 'Username',
                navItems: [
                    {
                        name: 'dataPegawai',
                        label: 'Data Pegawai',
                        link: '#',
                        isActive: true
                    },
                    {
                        name: 'dataKompetensi',
                        label: 'Data Kompetensi',
                        link: '#',
                        isActive: false
                    },
                    {
                        name: 'dataKinerja',
                        label: 'Data Kinerja',
                        link: '#',
                        isActive: false
                    },
                    {
                        name: 'dataTraining',
                        label: 'Data Training',
                        link: '#',
                        isActive: false
                    }
                ]
            }
        },
        methods: {
            navigateTo: function (navItemName) {
                let navItem;
                this.navItems.forEach(function (item) {
                    item.isActive = item.name === navItemName;
                    if (item.name === navItemName) {
                        navItem = item;
                    }
                });
                this.$emit('navigation', navItem);
            }
        },
        mounted() {
            console.log("Navbar mounted.");
        }
    }
</script>

<style>

</style>