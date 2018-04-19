<template>
    <div>
        <main role="main" class="container">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 p-2">
                            <button type="button"
                                    class="btn btn-primary m-1"
                                    @click="redirectAddUser">Tambah User</button>
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
        dataUserColumns: require('./configs/data-user-columns.json'),
        name: 'admin-main-page',
        components: {
            'admin-navbar': require('./AdminNavbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data User',
                columns: [],
                rows: [],
                dataUser: [],
            }
        },

        methods: {
            redirectAddUser: function() {
                let url = '/pages/admin/adduser';
                window.location.href = url;
            }
        },

        created: function() {
            axios.get('/api/user')
                .then(response => {
                    this.dataUser = response.data.data;
                    this.columns = this.$options.dataUserColumns;
                    this.rows = this.dataUser;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        }
    }
</script>

<style>

</style>