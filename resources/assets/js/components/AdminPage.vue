<template>
    <div>
        <header>
            <admin-navbar></admin-navbar>
        </header>
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
                        :rows="rows"
                        :lineNumbers="true">
            </data-table>
        </main>
        <footer>

        </footer>
    </div>
</template>

<script>

    import axios from 'axios'

    export default {
        name: 'admin-main-page',
        components: {
            'admin-navbar': require('./AdminNavbar.vue'),
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

        created: function() {
            this.getData();
        },

        methods:{
            getData() {
                axios.get('/api/user')
                    .then(response => {
                        this.rows.push(response.data);
                })
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<style>

</style>