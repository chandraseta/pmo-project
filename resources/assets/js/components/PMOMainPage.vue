<template>
    <div>
        <header>
            <pmo-navbar></pmo-navbar>
        </header>
        <main role="main" class="container">
            <data-table :tableTitle="title"></data-table>
        </main>
        <footer>

        </footer>
    </div>
</template>

<script>
    export default {
        name: 'pmo-main-page',
        components: {
            'pmo-navbar': require('./Navbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data Pegawai'
            }
        }
    }
</script>

<style>

</style>