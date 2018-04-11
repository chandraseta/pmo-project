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
                rows: [
                    {name: 'Andrew Ng', email:'andrew@ng.com'},
                    {name: 'Nathanael', email:'nathanael@bic.com'},
                    {name: 'Jonathan', email:'jona@than.com'},
                    {name: 'Iriana', email:'iriana@google.com'},
                    {name: 'Rando', email:'rando@wis.com'}
                ],
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
            // this.getData();
        },

        methods:{
            // getData() {
            //     axios.get('/api/user')
            //         .then(response => {
            //             this.rows.name.push(response.data.name);
            //             this.rows.email.push(response.data.email);
            //     })
            //         .catch(error => console.log(error));
            // }
        }
    }
</script>

<style>

</style>