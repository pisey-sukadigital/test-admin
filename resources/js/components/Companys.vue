<template>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            Add New
                        </button>
                        </div>
                    </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>secret</th>
                        <th>URL</th>
                        <th>Callback</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data in datas.data" :key="data.id">
                            <td> {{data.id}} </td>
                            <td> {{data.name}} </td>
                            <td> {{data.secret}} </td>
                            <td> {{data.url}} </td>
                            <td> {{data.callback}} </td>
                            <td> {{ data.status == '1' ? 'Active' : 'Disactive'}} </td>
                            <td> {{data.updated_at}} </td>
                            <td> {{data.created_at}} </td>
                            <td> 
                                <a href="#" class="text-muted">
                                    <i class="fas fa-edit text-info"></i>
                                </a>
                                /
                                <a href="#" class="text-muted" @click="deleteData(data)">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="createData(form)" @keydown="form.onKeydown($event)">
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <label>secret</label>
                            <input v-model="form.secret" type="text" name="secret"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('secret') }">
                            <has-error :form="form" field="secret"></has-error>
                        </div>

                        <div class="form-group">
                            <label>URL</label>
                            <input v-model="form.url" type="text" name="url"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('url') }">
                            <has-error :form="form" field="url"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Callback</label>
                            <input v-model="form.callback" type="text" name="callback"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('callback') }">
                            <has-error :form="form" field="callback"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <input v-model="form.status" type="text" name="status"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                            <has-error :form="form" field="status"></has-error>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary"
                        @click.prevent="createData(form)">Create</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {mapGetters} from 'vuex'

    let actions = {
        name: "company",
         data(){
            return {
                form: new Form({
                    name : '',
                    secret : '',
                    url : '',
                    callback : '',
                    status : ''
                    
                })
            }
        },
        mounted() {
            this.$store.dispatch('fetchDatas','/api/companys')
        },
        methods: {
            createData(form) {
                this.$store.dispatch('createData',['/api/companys',form]);
            },

            deleteData(data) {
                this.$store.dispatch('deleteData',['/api/companys',data]);
            },
        },
        computed: {
            ...mapGetters([
                'datas'
            ])
        }
    }
    export default actions
</script>
