<template>
    <div>
        <main role="main" class="container">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 p-2">
                            <button type="button" class="btn btn-primary m-1">Add User</button>
                        </div>
                    </div>
                </div>
            </section>
            <data-table :tableTitle="title"
                        :columns="columns"
                        :rows="rows">
            </data-table>
        </main>
        <footer>

        </footer>
    </div>
</template>

<script>
    export default {
        name: 'admin-main-page',
        components: {
            'admin-navbar': require('./Navbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data User',
                rows: [],
                columns: [
                    {
                        label: 'Nama Lengkap',
                        field: 'name'
                    },
                    {
                        label: 'E-mail',
                        field: 'email'
                    },
                ],
            }
        },
        methods:{
            getData() {
                axios.get('/api/user')
                    .then(response => {
                        this.rows.name = response.data.name;
                        this.rows.email = response.data.email;
                })
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<style>

</style>