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
                            Add New<i class="fas fa-user-plus fa-fw"></i>
                        </button>
                        </div>
                    </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Modify</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data in datas.data" :key="data.id">
                            <td> {{data.id}} </td>
                            <td> {{data.name}} </td>
                            <td> {{data.email}} </td>
                            <td> Append </td>
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
                <form @submit="createData()" @keydown="form.onKeydown($event)">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input v-model="form.email" type="text" name="email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="password" name="password" autocomplete="off"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input v-model="form.password_confirmation" type="password" name="password_confirmation" autocomplete="off"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
                            <has-error :form="form" field="password_confirmation"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary"
                        @click.prevent="createData()">Create</button>
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
        name: "users",
         data(){
            return {
                url: "/api/users",
                form: new Form({
                    name : '',
                    email : '',
                    password : '',
                    password_confirmation : '',
                })
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {
            fetchDatas() {
                this.$Progress.start()
                this.$store.dispatch('fetchDatas',this.url).then(response => {
                    if (response.status == '200'){
                        // message
                        this.$Progress.finish()
        
                    }
                }).catch(err => {
                    console.log('false fetchDatas')
                    this.$Progress.fail()
                })
            },
            createData() {

                // this.$store.dispatch('createData',['/api/users',this.form])
            
                this.form.post(this.url)
                 .then(({ data }) => { console.log(data) })
            },
            deleteData(data) {
                this.$store.dispatch('deleteData',['/api/users',data])
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