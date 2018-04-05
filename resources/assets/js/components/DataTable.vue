<template>
    <div>
        <vue-good-table
                :title="tableTitle"
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true"
                :globalSearch="true">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'editButton'">
                    <button class="btn btn-sm btn-default">Edit</button>
                </span>
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
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