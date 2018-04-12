<template>
    <div>
        <vue-good-table
                :title="tableTitle"
                :columns="columns"
                :rows="rows"
                :paginate="true"
                :lineNumbers="true"
                :searchOptions="{
                    enabled: true,
                    placeholder: 'Cari data'
                }"
                :paginationOptions="{
                    enabled: true,
                    perPage: 5
                }"
                styleClass="vgt-table striped condensed bordered">
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
                <span v-else-if="props.column.field == 'viewButton'">
                    <a class="btn btn-sm btn-default"
                       role="button" :href="'pegawai/' + props.row.originalIndex"
                       @click="viewProfile(props)">
                        View
                    </a>
                </span>
                <span v-else-if="props.row.originalIndex == rowBeingEdited && !props.column.immutable">
                    <input class="form-control"
                           :id="props.column.field + '-' + props.row.originalIndex"
                           :title="props.column.label"
                           :type="props.column.type == 'number' || 'date' ? props.column.type : 'text'"
                           v-model="dataBeingEdited[props.column.field]"/>
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
                rowBeingEdited: -1,
                dataBeingEdited: {}
            };
        },
        methods: {
            editRow(props) {
                this.rowBeingEdited = props.row.originalIndex;
                this.dataBeingEdited = props.row;
            },
            saveRow(props) {
                this.$emit('dataChange', this.dataBeingEdited);
                this.rowBeingEdited = -1;
                this.dataBeingEdited = {};
            },
            viewProfile(props) {

            }
        }
    };
</script>