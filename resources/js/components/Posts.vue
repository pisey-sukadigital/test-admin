<template>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col pl-2">
                                    <form type="get" class="form-inline mb-0">
                                        <div class="form-group mr-2">
                                            <select v-model="limit" @change="onSelected($event)" name="display" class="form-control d-inline-block col-md-12 rounded-0" style="width: auto;" id="show-select">
                                                <option>20</option>
                                                <option>50</option>
                                                <option>100</option>
                                                <option>200</option>
                                                <option>500</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control border-secondary border-right-0 rounded-0" type="search" placeholder="Search"  id="search">
                                        </div>
                                        <div class="form-group">
                                            <button class="form-control bg-primary btn-outline-secondary border-left-0 rounded-0 rounded-right btn-search" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                            </div>
                            <div class="col-auth">
                                <button class="btn btn-success" @click="showCreateForm()">
                                    <i class="fas fa-plus fa-fw"></i> Add New
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pl-2 pr-2 pt-2 pb-0">
                        <div class="table-responsive card card-primary card-outline">
                            <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in datas.data" :key="data.id">
                                    <td>{{data.id}}</td>
                                    <td>{{data.title}}</td>
                                    <td>{{data.content}}</td>
                                    <td>{{data.created_at | myDate}}</td>
                                    <td>{{data.updated_at | myDate}}</td>
                                    <td>
                                        <a href="#" class="text-muted" @click="showEditForm(data)"><i class="fas fa-edit text-info"></i></a>
                                    /
                                    <a href="#" class="text-muted" @click="deleteData(data)"><i class="fas fa-trash text-danger"></i></a></td>
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
                    <h5 class="modal-title" id="myModalLabel">Post {{ is_edit ? "edit":"creation" }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="ml-2 mr-2" enctype="multipart/form-data"
                 @submit="createData()" @keydown="form.onKeydown($event)">
                 <input type="hidden" name="id" v-model="form.id" >
                    <div class="form-group mt-2">
                        <input id="title" type="text" name="title" ref="title" placeholder="Post title" v-model="form.title" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.content" name="content" placeholder="Post content" class="form-control">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <button :disabled="!isValid" class="btn btn-block btn-primary" 
                        @click.prevent="sumit()">
                        {{ is_edit ? "Submit":"Create" }}
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Posts",
        data() {
            return {
                url: "/api/posts",
                is_edit: false,
                form: new Form({ id: '', title: '', content: '' }),
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
                url += '&&limit='+ this.limit

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

            showCreateForm(){
                this.statusModule('show');
                this.form.reset();
                this.$refs.title.focus()
                this.is_edit = false;
            },

            createData() {

                this.$Progress.start()
                this.form.post(this.url).then(({ response }) => {
                    this.$Progress.finish()
                    this.statusModule('hide');
                    this.fetchDatas();
                    Fire.$emit('AfterCreate');
                    this.displayToastMessage('success','Post create successfully');
                })
                .catch(err => {
                    this.$Progress.fail()
                    console.log('false createData')
                    this.displayToastMessage('error','false deleteData');
                });
            },

            showEditForm(data){
                this.statusModule('show');
                this.is_edit = true;
                this.form.fill(data);
            },

            updateData() {
                this.$store.dispatch('updateData', [this.url+'/'+this.form.id,this.form])
                .then(response => {
                    if (response.status == '200'){
                        this.fetchDatas();
                        this.statusModule('hide');
                        this.displayToastMessage('success','Updated post successfully');
                    }
                }).catch(err => {
                    console.log('false updateData')
                    this.displayToastMessage('error','false updateData');
                })
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
                                this.displayToastMessage('success','Deleted post successfully');
                            }
                        }).catch(err => {
                            this.$Progress.fail()
                            this.displayToastMessage('error','false deleteData');
                        })
                    }
                })
            },

            sumit(){
                this.is_edit ? this.updateData() : this.createData();
            },
            
            statusModule(status){
                $('#myModal').modal(status);
            },
            
            displayToastMessage(State,Message){
                toast.fire({
                    icon: State,
                    title: Message
                })
            },
            onSelected(event) {
                console.log(event.target.value);
                this.limit = event.target.value;
                this.fetchDatas();
            }
        },
        computed: {
            ...mapGetters([ 'datas' ]),
            isValid() {
                return this.form.title !== '' && this.form.content !== '';
            }
        },
        created(){
            Fire.$on('AfterCreate',()=>{
                console.log('Event on AfterCreate');
            });
        }
    }
</script>

<style scoped></style>
