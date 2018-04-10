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
                    <button class="btn btn-sm btn-default"
                            v-if="props.row.originalIndex != rowBeingEdited"
                            :disabled="rowBeingEdited != -1"
                            @click="editRow(props)">
                        Edit
                    </button>
                    <button class="btn btn-sm btn-primary"
                            v-else
                            @click="saveRow(props)">
                        Save
                    </button>
                </span>
                <span v-else-if="props.row.originalIndex == rowBeingEdited && !props.column.immutable">
                    <input class="form-control"
                           :id="props.column.field + '-' + props.row.originalIndex"
                           :title="props.column.label"
                           :type="props.column.type == 'number' || 'date' ? props.column.type : 'text'"
                           :value="props.formattedRow[props.column.field]"/>
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
                rowBeingEdited: -1
            };
        },
        methods: {
            editRow(props) {
                this.rowBeingEdited = props.row.originalIndex;
                console.log(props);
            },
            saveRow(props) {
                this.rowBeingEdited = -1;
            }
        }
    };
</script>