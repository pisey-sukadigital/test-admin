<template>
    <div v-if="$can(permission)" class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 pb-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button v-if="$can('system-modules-create')" class="btn btn-success" @click="showStatus('create','')">
                                            Add <i class="fas fa-plus fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive card card-primary card-outline">
                                    <table class="table table-hover table-striped table-bordered table-valign-middle">
                                    <thead class="table-primary">
                                    <tr >
                                        <th>Name</th>
                                        <th>Disaply	</th>
                                        <th>Route name</th>
                                        <th>Symbol</th>
                                        <th>Parent</th>
                                        <th>sort</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                        <tbody>
                                            <template v-for="data in items.data">
                                                <tr :key="data.id">
                                                    <td> {{data.name}} </td>
                                                    <td> {{data.display}} </td>
                                                    <td> {{data.link}} </td>
                                                    <td> <i class="nav-icon" v-bind:class="data.symbol"></i> {{data.symbol}} </td>
                                                    <td>  </td>
                                                    <td> {{data.sort}} </td>
                                                    <td> {{data.is_active == 1 ? 'Active':'Disactive'}} </td>
                                                    <td> 
                                                        <a v-if="$can('system-user-create')" class="btn p-0" @click="showStatus('edit',data)">
                                                            <i class="fas fa-edit text-info"></i>
                                                        </a>
                                                        /
                                                        <a v-if="$can('system-user-delete')" class="btn p-0" @click="showStatus('delete',data)">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr v-for="child in data.children" :key="child.id">
                                                    <td> {{child.name}}  </td>
                                                    <td> {{child.display}} </td>
                                                    <td> {{child.link}} </td>
                                                    <td> {{child.symbol}} </td>
                                                    <td> {{data.name}} </td>
                                                    <td> {{child.sort}} </td>
                                                    <td> {{child.is_active == 1 ? 'Active':'Disactive'}} </td>
                                                    <td> 
                                                        <a v-if="$can('system-user-create')" class="btn p-0" @click="showStatus('edit',child)">
                                                            <i class="fas fa-edit text-info"></i>
                                                        </a>
                                                        /
                                                        <a v-if="$can('system-user-delete')" class="btn p-0" @click="showStatus('delete',child)">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </template>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div>
        
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" :class="{ 'modal-lg': (this.status != 'delete') }">
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
                            <div v-if="status == 'delete'" class="modal-body">
                                <div class="text-center">
                                    <h3>
                                        Are you sure want to delete?
                                    </h3>
                                </div>
                            </div>
                            <div class="modal-body" v-else>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="form.name" name="name"
                                        :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Display :</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" v-model="form.display" type="text" name="display"
                                        :class="{ 'is-invalid': form.errors.has('display') }">
                                        <has-error :form="form" field="display"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Link :</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" v-model="form.link" type="text" name="link"
                                        :class="{ 'is-invalid': form.errors.has('link') }">
                                        <has-error :form="form" field="link"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Symbol :</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" v-model="form.symbol" type="text" name="symbol">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Parent :</label>
                                    <div class="col-sm-10">
                                        <select v-model="form.parent_id" name="parent_id" class="form-control" >
                                            <option value="0">No parent </option>
                                            <option v-for="module in items.data" :key="module.id" 
                                                v-bind:value="module.id">
                                                    {{ module.name }}
                                                </option>
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Sort :</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  v-model="form.sort" type="number" name="sort"
                                        :class="{ 'is-invalid': form.errors.has('sort') }">
                                        <has-error :form="form" field="sort"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Active :</label>
                                    <div class="col-sm-10">
                                        <select v-model="form.is_active" name="is_active" class="form-control" >
                                            <option selected value="1">Active</option>
                                            <option selected value="0">Disactive </option>
                                        </select>
                                    </div>
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
    export default {
        name: "modual",
        data(){
            return {
                name: 'Modules',
                permission: 'system-modules',
                url_get: window.BaseUrl+"/api/modules?page=",
                url_add: window.BaseUrl+"/api/modules/add",
                url_delete: window.BaseUrl+"/api/modules/delete/",
                url_update: window.BaseUrl+"/api/modules/update/",
                items: {},
                modules: {},
                status:'',
                btn_sumit: '',
                title: '',
                form: new Form({
                    id:'',
                    name : '',
                    display: '',
                    link: '',
                    symbol: '',
                    parent_id: '',
                    sort: '',
                    is_active: '',
                }),
            }
        },
        mounted() {
            this.fetchDatas();
          
        },
        methods: {

            fetchDatas(page = 1) {
                this.$Progress.start(); 
                this.form.get(this.url_get + page).then(response => {
                    this.items =  response.data;
                    this.$Progress.finish();
                }).catch(err => {
                     this.$Progress.fail();
                });
            },

            showStatus(status,data){
                this.status = status;
                if(status == 'edit'){
                    this.btn_sumit = "Update";
                    this.title = "Edit module";
                    this.form.reset();
                    this.form.clear();
                    this.form.fill(data); 
                    this.statusModule('show');
                }else if(status == 'create'){
                    this.btn_sumit = "Create";
                    this.title = "Create module";
                    this.form.reset();
                    this.form.link = '#';
                    this.form.parent_id = 0;
                    this.form.sort = 0; 
                    this.form.symbol = ''; 
                    this.form.is_active = '1';
                    this.statusModule('show');
                    
                }else if(status == 'delete'){
                    this.form.id = data.id
                    this.statusModule('show');
                    this.btn_sumit = "Delete";
                    this.status = 'delete';
                }
            },

            statusModule(status){
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
                this.form.delete(this.url_delete+this.form.id).then(response => {
                    let index = this.items.data.findIndex(item => item.id === this.form.id);
                    this.items.data.splice(index, 1);
                    this.form.reset();
                    this.statusModule('hide');
                    this.$Progress.finish();
                    toast.fire({
                        icon: 'success',
                        title: 'modual delete successfully'
                    });
                }).catch(err => {
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'false delete'
                    })
                });
            },
        } 
    }
   
</script>