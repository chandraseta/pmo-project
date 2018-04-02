<template>
    <div>
        <vue-good-table
                :title="tableTitle"
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true"
                :globalSearch="true">
        </vue-good-table>
    </div>
</template>

<script>
    export default {
        name: 'data-table',
        props: [
            'tableTitle',
            'columns',
            'rows'
        ],
        data(){
            return {

            };
        },
    };
</script>