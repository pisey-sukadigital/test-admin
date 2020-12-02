<template>
    <div v-if="$can(name)" class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 pb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button v-if="$can('system-user-create')" class="btn btn-success" @click="showStatus('create','')">
                                            Add <i class="fas fa-plus fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive card card-primary card-outline">
                                    <table class="table table-hover table-striped table-bordered table-valign-middle">
                                    <thead class="table-primary">
                                    <tr>
                                        <th width="5%" class="text-center">ID</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Modify</th>
                                    </tr>
                                    </thead>
                                        <tbody>
                                            <tr v-for="data in items.data" :key="data.id">
                                                <td class="text-center"> {{data.id}} </td>
                                                <td class="text-center"> {{data.username}} </td>
                                                <td class="text-center"> {{data.email}} </td>
                                                <td class="text-center">
                                                    <span v-for="role in data.roles" :key="role.id">
                                                        {{ role.name }}
                                                    </span> 
                                                    </td>
                                                <td class="text-center"> 
                                                    <a v-if="$can('system-user-create')" href="#" @click="showStatus('edit',data)">
                                                        <i class="fas fa-edit text-info"></i>
                                                    </a>
                                                    /
                                                    <a v-if="$can('system-user-delete')" href="#" @click="showStatus('delete',data)">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <pagination :data="items"  @pagination-change-page="fetchDatas" :limit="2" :align="'right'" ></pagination>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div>
        
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">
                                {{ title }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit="sumit()" @keydown="form.onKeydown($event)" autocomplete="off">
                            <input type="hidden" v-model="form.id" name="id">
                            <div v-if="status != 'delete'" class="modal-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input autocomplete="off" v-model="form.username" type="text" name="username" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                                    <has-error :form="form" field="username"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input autocomplete="off" v-model="form.email" type="text" name="email"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input autocomplete="off" v-model="form.password" type="password" name="password" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input autocomplete="off" v-model="form.confirm_password" type="password" name="confirm_password"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('confirm_password') }">
                                    <has-error :form="form" field="confirm_password"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Company</label>
                                    <input autocomplete="off" v-model="form.company" type="text" name="company" 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('company') }">
                                    <has-error :form="form" field="company"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select v-model="form.roles" multiple="multiple" name="roles[]"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('roles') }">
                                        <option v-for="role in all_roles" :key="role.id" 
                                        v-bind:value="role.name">
                                            {{ role.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="roles"></has-error>
                                </div>
                            </div>
                            <div v-else>
                                <div class="text-center"><h3>
                                    Are you sure want to delete?
                                </h3></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" type="submit" class="btn btn-primary"
                                @click.prevent="sumit()">
                                    {{ btn_sumit }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="text-center mt-2 pt-2 pb-2 bg-danger">
          <h2>Permission denied</h2>
        </div>
    </div>
</template>

<script>
    export default {
        name: "users",
        data(){
            return {
                name: 'system-users',
                url_get: window.BaseUrl+"/api/users?page=",
                url_add: window.BaseUrl+"/api/users/add",
                url_delete: window.BaseUrl+"/api/users/delete/",
                url_update: window.BaseUrl+"/api/users/update/",
                all_roles:[],
                items:{},
                status:'',
                btn_sumit: '',
                title: '',
                form: new Form({
                    id:'',
                    username : '',
                    email : '',
                    password : '',
                    confirm_password : '',
                    company : '',
                    roles:[]
                }),
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {

            fetchDatas(page = 1) {
                this.$Progress.start()
                this.form.get(this.url_get + page).then(response => {
                    this.items =  response.data;
                    this.$Progress.finish();
                }).catch(err => {
                     this.$Progress.fail();
                });
            },

            fetchAllRole(){
                axios.get("/api/roles/all").then(response => {
                    this.all_roles = response.data.data;
                });
            },
            
            showStatus(status,data){
                this.status = status;
                if(status == 'edit'){
                    this.btn_sumit = "Update";
                    this.title = "Update user";
                    this.statusModule('show');
                    this.form.reset();
                    this.form.clear();
                    console.log(data);
                    this.form.fill(data); 
                    this.form.roles = [];
                    data.roles.forEach(element => {
                        this.form.roles.push(element.name);
                    });

                }else if(status == 'create'){
                    this.btn_sumit = "Create";
                    this.title = "Create user";
                    this.form.reset();
                    this.form.clear();
                    this.statusModule('show');
                   
                }else if(status == 'delete'){
                    this.btn_sumit = "Delete";
                    this.title = "";
                    this.statusModule('show');
                    this.form.reset();
                    this.form.clear();
                    this.form.fill(data); 
                   
                }
            },

            statusModule(status){
                if(status == 'show'){
                    if(this.all_roles.length <= 0){
                        this.fetchAllRole();
                    }
                }
                $('#myModal').modal(status);
            },

            sumit(){
                if(this.status == 'create'){
                    this.createData();
                }else if(this.status == 'edit'){
                    this.updateDate();

                }else if(this.status == 'delete'){
                    this.deleteData();
                }
            },

            createData() {
                this.$Progress.start();
                this.form.post(this.url_add).then(response => {
                    this.items.data.unshift(response.data);
                    this.form.reset();
                    this.statusModule('hide');
                    this.$Progress.finish();
                    toast.fire({
                        icon: 'success',
                        title: 'Company create successfully'
                    });

                }).catch(err => {

                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'false createData'
                    })
                   
                });
            },

            updateDate(){
                this.$Progress.start();
                this.form.post(this.url_update+this.form.id).then(response => {
                    let index = this.items.data.findIndex(item => item.id === response.data.id);
                    this.items.data[index] = response.data;
                    this.form.reset();
                    this.statusModule('hide');
                    this.$Progress.finish();
                    toast.fire({
                        icon: 'success',
                        title: 'Updated successfully'
                    });
                }).catch(err => {
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'false updatedate'
                    })
                });
            },

            deleteData() {
                this.form.delete(this.url_delete+this.form.id).then(response => {
                    let index = this.items.data.findIndex(item => item.id === this.form.id);
                    this.items.data.splice(index, 1);
                    this.form.reset();
                    this.statusModule('hide');
                    this.$Progress.finish();
                    toast.fire({
                        icon: 'success',
                        title: 'Deleted successfully'
                    });
                }).catch(err => {
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'false deleted'
                    })
                });
            },
        }
    }
</script>