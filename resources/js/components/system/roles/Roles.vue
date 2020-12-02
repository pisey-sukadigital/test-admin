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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <tr v-for="data in items.data" :key="data.id">
                                                    <td> {{data.id}}</td>
                                                    <td> {{data.name}}  {{ data.children }}</td>
                                                    <td> {{data.created_at | formatDate}} </td>
                                                    <td> {{data.updated_at | formatDate}} </td>
                                                    <td> 
                                                        <a v-if="$can('system-user-create')" class="btn p-0" @click="showStatus('show',data)">
                                                            <i class="fas fa-eye text-info"></i>
                                                        </a>
                                                        /
                                                        <a v-if="$can('system-user-create')" class="btn p-0" @click="showStatus('edit',data)">
                                                            <i class="fas fa-edit text-info"></i>
                                                        </a>
                                                        /
                                                        <a v-if="$can('system-user-delete')" class="btn p-0" @click="showStatus('delete',data)">
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
            </div><!-- /.container-fluid -->
        
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document"
                :class="{ 'modal-lg': (this.status != 'delete') }">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">
                            {{ this.title }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit="sumit()" @keydown="form.onKeydown($event)" autocomplete="off">
                        <div v-if="status == 'show'" class="modal-body">
                            <div class="form-group">
                                <label>Name :</label>
                                <input autocomplete="off" v-model="form.name" type="text" name="name"
                                    disabled class="form-control">
                                
                            </div>
                            <div class="form-group">
                                <label>Permissions :</label><br>
                                <span class="badge badge-pill badge-info text-white mr-1" v-for="permission in form.permissions" :key="permission.id">
                                    {{ permission }}
                                </span>
                            </div>
                        </div>

                        <div v-if="status == 'edit'" class="modal-body">
                            <div class="form-group">
                                <label>Name :</label>
                                <input autocomplete="off" v-model="form.name" type="text" name="name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Permissions :</label>
                                <div class="row">
                                    <div class="col-6 col-md-3" v-for="(permission,index) in permissions" :key="permission.id">
                                         <input type="checkbox" name="permissions[]" :id="'permission_'+index" 
                                         :class="{ 'is-invalid': form.errors.has('permissions') }"
                                         :value="permission.name" v-model="form.permissions">
                                            <label :for="'permission_'+index">{{ permission.name }}</label>
                                    </div>
                                </div>
                                <div :class="{ 'is-invalid': form.errors.has('permissions') }"></div>
                                <has-error :form="form" field="permissions"></has-error>
                            </div>
                        </div>

                        <div v-if="status == 'create'" class="modal-body">
                             <div class="form-group">
                                <label>Name :</label>
                                <input autocomplete="off" v-model="form.name" type="text" name="name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Permissions :</label>
                                <div class="row">
                                    <div class="col-6 col-md-3" v-for="(permission,index) in permissions" :key="permission.id">
                                         <input type="checkbox" name="permissions[]" :id="'permission_'+index" 
                                         :class="{ 'is-invalid': form.errors.has('permissions') }"
                                         :value="permission.name" v-model="form.permissions">
                                            <label :for="'permission_'+index">{{ permission.name }}</label>
                                    </div>
                                </div>
                                <div :class="{ 'is-invalid': form.errors.has('permissions') }"></div>
                                <has-error :form="form" field="permissions"></has-error>
                            </div>
                        </div>

                        <div v-if="status == 'delete'" class="modal-body">
                            <div class="text-center">
                                <h3>
                                    Are you sure want to delete role?
                                </h3>
                            </div>
                        </div>

                        <div class="modal-footer" v-if="status != 'show'">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary"
                            @click.prevent="sumit()">
                                {{ this.btn_sumit  }}
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
    export default  {
        name: "users",
        data(){
            return {
                name: 'system-roles',
                url_get: window.BaseUrl+"/api/roles?page=",
                url_get_all: window.BaseUrl+"/api/roles/all",
                url_add: window.BaseUrl+"/api/roles/add",
                url_edit: window.BaseUrl+"/api/roles/edit/",
                url_delete: window.BaseUrl+"/api/roles/delete/",
                url_update: window.BaseUrl+"/api/roles/update/",

                permissions:[],
                all_roles:[],
                status: '',
                title: '',
                btn_sumit: '',
                items:{},
                form: new Form({
                    id:'',
                    name : '',
                    permissions:[]
                }),
            }
        },
        mounted() {
            this.fetchDatas();
            this.fetchPermission();
        },
        methods: {

            fetchPermission(){
                axios.get('/api/roles/permission').then(response => {
                    if (response.status == '200'){
                        this.permissions = response.data;
                    }
                }).catch(err => {

                })
            },

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
                this.form.get(this.url_get_all)
                .then(response => {
                    this.all_roles = response.data.data;
                }).catch(err => {
                });
            },

            fetchRole($id){
                this.$Progress.start();
                this.form.get(this.url_edit+$id)
                .then(response => {
                    if(response.data[0]){
                        this.form.name = response.data[0].name;
                        this.form.id = response.data[0].id;
                    }
                    if(response.data[1]){
                        this.form.permissions = response.data[1];
                    }
                    this.$Progress.finish()
                }).catch(err => {
                    this.$Progress.fail()
                });
            },

            createData() {
                this.$Progress.start()
                this.form.post(this.url_add).then(response => {
                    this.items.data.unshift(response.data);
                    this.form.reset();
                    this.statusModule('hide');
                    this.$Progress.finish();

                    toast.fire({
                        icon: 'success',
                        title: ' create successfully'
                    });

                }).catch(err => {
                    this.$Progress.fail();
                     console.log(err);
                    toast.fire({
                        icon: 'error',
                        title: ' false createData'
                    })
                });
            },

            deleteData(){
                this.$Progress.start()
                this.form.delete(this.url_delete+this.form.id).then(response => {
                    let index = this.items.data.findIndex(item => item.id === this.form.id);
                    this.items.data.splice(index, 1);
                    this.form.reset();
                    this.statusModule('hide');
                    this.$Progress.finish();
                    toast.fire({
                        icon: 'success',
                        title: 'delete successfully'
                    });
                }).catch(err => {
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'false delete'
                    })
                });
            },

            showStatus(status,data){
                this.statusModule('show');
                if(this.permissions.length <= 0){
                    this.fetchPermission();
                }
                if(status == 'show'){
                    this.title = "Show role";
                    this.status = 'show';
                    this.fetchRole(data.id);
                }else if(status == 'edit'){
                    this.title = "Edit role";
                    this.btn_sumit = "Update";
                    this.status = 'edit';
                    this.fetchRole(data.id);
                }else if(status == 'create'){
                    this.form.name = "";
                    this.form.permissions = [];
                    this.title = "Create role";
                    this.btn_sumit = "Create";
                    this.status = 'create';
                }else if(status == 'delete'){
                    this.title = "";
                    this.btn_sumit = "Delete";
                    this.status = 'delete';
                    this.form.id = data.id;
                }
            },

            showUpdateData(data){
                this.statusModule('show');
                this.form.reset();
                this.form.clear();
                this.form.fill(data); 
                this.form.roles = [];
                data.roles.forEach(element => {
                    this.form.roles.push(element.name);
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

            statusModule(status){
                if(status == 'show'){
                    this.fetchAllRole();
                }
                $('#myModal').modal(status);
            },

            sumit(){
                if(this.status == 'edit'){
                     this.updateDate();
                }else if(this.status == 'create'){
                    this.createData();
                }else if(this.status == 'delete'){
                    this.deleteData();
                }
            },
        }
    }
</script>