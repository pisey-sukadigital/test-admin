<template>
    <div v-if="$can(name)" class="content">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 p-0">
                            </div>
                            <div class="card-body p-2">
                                <div class="table-responsive card card-primary card-outline">
                                <table class="table table-hover table-striped table-bordered table-valign-middle">
                                <thead class="table-primary">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Subject	</th>
                                    <th class="text-center">Method</th>
                                    <th class="text-center">IP</th>
                                    <th class="text-center">Agent</th>
                                    <th class="text-center">Before</th>
                                    <th class="text-center">After</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        <tr v-for="data in items.data" :key="data.id">
                                            <td class="text-center"> {{ data.id }} </td>
                                            <td class="text-center"> {{ data.user ? data.user.name : '' }} </td>
                                            <td class="text-center"> {{data.subject | strToUpper}} </td>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill text-white"
                                                :class="getbage(data.action)">{{ data.action }}</span></h5>
                                            </td>
                                            <td class="text-center"> {{data.ip}} </td>
                                            <td class="text-center">
                                                {{ data.agent | substring }}
                                            </td>
                                            <td class="text-center"> 
                                                {{ data.before | substring }}
                                            </td>
                                            <td class="text-center"> 
                                                {{ data.after | substring }}
                                            </td>
                                             <td class="text-center"> 
                                                {{ data.created_at }}
                                            </td>
                                            <td class="text-center"> 
                                                <a class="btn p-0" @click="showStatus('show',data)">
                                                   <i class="fas fa-eye text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr v-if="items.data && items.data.length == 0">
                                            <td colspan="10" class="text-center"> 
                                                No data
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="myModalLabel" class="modal-title">
                            Log activity show:
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div v-if="status == 'show'" class="modal-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label text-right">Username :</label>
                            <div class="col-sm-10 text-break pt-2">
                                {{form.username }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-sm-2 col-form-label text-right">Subject :</label>
                                <div class="col-sm-10 text-break pt-2">
                                {{form.subject }}
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-right">URL :</label>
                            <div class="col-sm-10 text-break pt-2">
                                {{form.url }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-right">Action :</label>
                                <div class="col-sm-10 text-break pt-2">
                                {{form.action }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ip" class="col-sm-2 col-form-label text-right">IP :</label>
                            <div class="col-sm-10 text-break pt-2">
                                {{form.ip }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agent" class="col-sm-2 col-form-label text-right">Agent :</label>
                                <div class="col-sm-10 text-break pt-2">
                                {{form.agent }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="before" class="col-sm-2 col-form-label text-right">Before :</label>
                            <div class="col-sm-10 text-break pt-2">
                                {{form.before }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="after" class="col-sm-2 col-form-label text-right">After :</label>
                            <div class="col-sm-10 text-break pt-2">
                                {{form.after }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agent" class="col-sm-2 col-form-label text-right">Agent :</label>
                                <div class="col-sm-10 text-break pt-2">
                                {{form.created_at }}
                            </div>
                        </div>
                        
                    </div>
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
                name: 'system-modules',
                url: "/api/log_activity",
                status: '',
                items: {},
                form: new Form({
                    id : '',
                    username : '',
                    subject: '',
                    url: '',
                    action: '',
                    ip: '',
                    agent: '',
                    before: '',
                    after: '',
                    created_at: '',
                }),
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {
            fetchDatas(page = 1) {
                this.$Progress.start()
                var url = this.url+'?page=' + page;  
                
                this.form.get(url).then(response => {
                    this.items =  response.data;
                    this.$Progress.finish();
                }).catch(err => {
                     this.$Progress.fail();
                });
            },

            showStatus(status,data){
                if(status == 'show'){
                    this.form.fill(data);
                    this.form.username = data.user.name;
                    this.status = 'show';
                    this.statusModule('show');
                }
            },

            statusModule(status){
                $('#myModal').modal(status);
            },

            getbage(text){
                switch (text) {
                    case 'Created':
                        return 'badge-success';
                    case 'Updated':
                        return 'badge-primary';
                    case 'Deleted':
                        return 'badge-danger';
                    case 'Login':
                        return 'badge-info';
                    case 'Logout':
                        return 'badge-dark';
                    default:
                        return '';
                }
            }
        }
    }
   
</script>