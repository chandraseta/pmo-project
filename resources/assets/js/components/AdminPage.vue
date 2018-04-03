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
                columns: [],
                dataUserColumns:[
                    {
                        label: 'Username',
                        field: 'username',
                    },
                    {
                        label: 'NIP',
                        field: 'nip',
                    },
                    {
                        label: 'Nama Lengkap',
                        field: 'name'
                    },
                    {
                        label: 'E-mail',
                        field: 'email'
                    },
                ],
                rows: [],
                dataUser: [
                    {id:1, username:'shigure', nip:'172859212', name:'Shigure', email:'shigure@sailor.com'},
                    {id:2, username:'tokiwa-matsu', nip:'175821032', name:'Tokiwa Matsu', email:'tokiwa-matsu@sailor.com'},
                    {id:3, username:'ku-jaku', nip:'114828124', name:'Ku Jaku', email:'ku-jaku@iroshizuku.com'}
                ],
            }
        },
        created: function () {
            this.rows = this.dataUser;
            this.columns = this.dataUserColumns;
        }
    }
</script>

<style>

</style>