<template>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0 mb-0">
                        <h3 class="card-title">Posts</h3>
                        <div class="card-tools">
                        <button class="btn btn-success" @click="showCreateForm()">
                            <i class="fas fa-plus fa-fw"></i> Add New
                        </button>
                            <div class="card-tools">
                                <pagination :data="laravelData" size="small" v-on:pagination-change-page="fetchDatas"></pagination>
                            </div>
                        </div>
                    </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-valign-middle">
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
                        <tr v-for="data in laravelData.data" :key="data.id">
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
                        <div class="row">
                            <div class="col-md-6">
                                <button :disabled="!isValid" class="btn btn-block btn-primary" 
                                    @click.prevent="sumit()"> {{ is_edit ? "Submit":"Create" }}
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    
    export default {
        name: "Posts",
        props : {size: String},
       
        data() {
            return {
                url: "/api/posts",
                is_edit: false,
                form: new Form({ id: '', title: '', content: '' }),
                laravelData: {}, 
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {
            fetchDatas(page = 1) {
                this.$Progress.start()
                this.$store.dispatch('fetchDatas',this.url + "?page=" + page).then(response => {
                    if (response.status == '200'){
                        // message
                        this.laravelData = response.data;
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

                this.form.post(this.url)
                 .then(({ data }) => { console.log(data) })

                // this.$Progress.start()
                // this.$store.dispatch('createData', [this.url,this.form])
                // .then(response => {
                //     if (response.status == '200'){
                //         // message
                //         this.$Progress.finish()
                //         this.statusModule('hide');
                //         Fire.$emit('AfterCreate');
                //         this.displayToastMessage('success','Post create successfully');
                //     }
                // }).catch(err => {
                //     this.$Progress.fail()
                //     console.log('false createData')
                //     this.displayToastMessage('error','false deleteData');
                // })
            },

            showEditForm(data){
                this.$Progress.start()
                this.statusModule('show');
                this.is_edit = true;
                this.form.fill(data);
                 this.$Progress.finish()
            },

            updateData() {
                this.$store.dispatch('updateData', [this.url+'/'+this.form.id,this.form])
                .then(response => {
                    console.log("updateData");
                    if (response.status == '200'){
                        this.updateTable();
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
                                console.log(response.status);
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
            
            updateTable(){
                for (let index = 0; index < this.datas.data.length; index++) {
                    const element = this.datas.data[index];
                    if(element.id == this.form.id ){
                        element.title = this.form.title;
                        element.content = this.form.content;
                    }
                }
                this.form.reset();
            },

            displayToastMessage(State,Message){
                toast.fire({
                    icon: State,
                    title: Message
                })
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