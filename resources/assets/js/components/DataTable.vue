<template>
    <div>
        <vue-good-table
                :title="tableTitle"
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true">
        </vue-good-table>
    </div>
</template>

<script>
    export default {
        name: 'test',
        props: [
            'tableTitle'
        ],
        data(){
            return {
                columns: [
                    {
                        label: 'NIP',
                        field: 'nip'
                    },
                    {
                        label: 'Nama',
                        field: 'name'
                    },
                    {
                        label: 'Unit',
                        field: 'unit'
                    },
                    {
                        label: 'No. Telp.',
                        field: 'phone'
                    },
                    {
                        label: 'Pendidikan',
                        field: 'education'
                    },
                    {
                        label: 'Tanggal Lahir',
                        field: 'birthday'
                    },
                ],
                rows: [
                    {id:1, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"}
                ],
            };
        },
    };
</script>