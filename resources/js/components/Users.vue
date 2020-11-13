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
                            <input v-model="form.confirm_password" type="password" name="confirm_password" autocomplete="off"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('confirm_password') }">
                            <has-error :form="form" field="confirm_password"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <selectRole></selectRole>
                            <has-error :form="form" field="roles[]"></has-error>
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

    import {mapGetters} from 'vuex';
    import SelectRole from './system/roles/SelectRole.vue';

    let actions = {
        name: "users",
        components: {SelectRole: SelectRole},
        data(){
            return {
                url: "/api/users",
                items:[],
                form: new Form({
                    name : '',
                    email : '',
                    password : '',
                    confirm_password : '',
                })
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {
            fetchDatas() {
                this.$store.dispatch('fetchDatas',this.url).then(response => {
                    if (response.status == '200'){
                        // message
                        this.items = response.data;
                        this.$Progress.finish()
                    }
                }).catch(err => {
                     console.log('false fetchDatas err');
                    if (err.response.status == 422){
                        console.log('false fetchDatas err');
                        console.log(err.response.data.errors);
                        this.$Progress.finish()
                    }
                     
                    this.$Progress.fail()
                })

            },
            createData() {

                console.log("createData");

                this.$store.dispatch('createData', [this.url,this.form])
                .then(response => {
                    if (response.status == '200'){
                        this.statusModule('hide');
                        this.$Progress.finish()
                        toast.fire({
                            icon: 'success',
                            title: 'Company create successfully'
                        })
                    } 
                }).catch(err => {
                    toast.fire({
                        icon: 'error',
                        title: 'false createData'
                    })
                })
                // this.$Progress.start()

                //  this.form.post(this.url).then(function(response){
                //     if(response.data.status == 'success'){
                //          console.log('successful'); 
                //         // Swal.fire('OK',response.data.message,'success') // or call another component
                //     }else{
                //         console.log('error'); 
                //         // Swal.fire('Error',response.data.error,'error')   
                //     }
                // })

                // this.form.post(this.url)
                //     .then(( response ) => { 
                //         console.log('successful'); 
                //         this.$Progress.finish()
                //         this.form.reset();
                //     });

                // this.$store.dispatch('createData',['/api/users',this.form])
            
                
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