<template>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                            Add New<i class="fas fa-user-plus fa-fw"></i>
                        </button>
                        </div>
                    </div>
                <div class="card-body pl-2 pr-2 pt-2 pb-0">
                    <div class="table-responsive card card-primary card-outline">
                        <table class="table table-hover table-striped table-bordered">
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
                <div class="card-footer">
                    <pagination :data="datas"  @pagination-change-page="fetchDatas" :limit="2" :align="'right'" ></pagination>
                </div>
                </div>
            </div>
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModal">Create user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="createData(form)" @keydown="form.onKeydown($event)">
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
        name: "users",
         data(){
            return {
                url: "/api/users",
                form: new Form({
                    name : '',
                    email : '',
                    password : '',
                    password_confirmation : '',
                }),
                limit:20,
                search:''
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {
            fetchDatas(page = 1) {
                this.$Progress.start()
                var url = this.url+'?page=' + page;  
                this.$store.dispatch('fetchDatas',url).then(response => {
                    if (response.status == '200'){
                        // message
                        this.$Progress.finish()
                    }
                }).catch(err => {
                    console.log('false fetchDatas')
                    this.$Progress.fail()
                })
            },
            createData(form) {
                this.$Progress.start()
                this.form.post(this.url).then(({ response }) => {
                    console.log(response);
                     $('#myModal').modal('hide');
                    this.fetchDatas();
                    this.form.reset();
                    toast.fire({
                        icon: 'success',
                        title: 'Company create successfully'
                    })
                })
                .catch(err => {
                    this.$Progress.fail()
                });

            },
            deleteData(data) {
                swal.fire({
                    title: 'Are you sure to delete?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    }).then((result) => {

                    if (result.isConfirmed) {
                        this.$Progress.start()
                        this.$store.dispatch('deleteData',[this.url,data]).then(response => {
                            if (response.status == '200'){
                                // message
                                this.$Progress.finish()
                                toast.fire({
                                    icon: 'success',
                                    title: 'User deleted successfully'
                                })
                            }
                        }).catch(err => {
                            this.$Progress.fail()
                            toast.fire({
                                icon: 'error',
                                title: 'false deleteData'
                            })
                        })
                    }
                })

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
