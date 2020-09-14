<template>
    
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Posts</h3>
                        <div class="card-tools">
                        <!-- <button class="btn btn-success" data-toggle="modal" data-target="#myModal"> -->
                        <button class="btn btn-success" @click="showCreateForm()">
                            <i class="fas fa-plus fa-fw"></i> Add New
                        </button>
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
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Post title" v-model="form.title" class="form-control">
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
            }
        },
        mounted() {
            this.fetchDatas();
            //  this.$Progress.finish()
        },
        methods: {

            fetchDatas() {
                // this.$Progress.start()
                this.$store.dispatch('fetchDatas',this.url).then(response => {
                    if (response.status == '200'){
                        // message
                    }
                }).catch(err => {
                    console.log('false fetchDatas')
                })
            },

            showCreateForm(){
                this.statusModule('show');
                this.is_edit = false;
                this.form.reset();
            },

            createData() {
                this.$store.dispatch('createData', [this.url,this.form])
                .then(response => {
                    if (response.status == '200'){
                        // message
                        this.statusModule('hide');
                        
                    }
                }).catch(err => {
                    console.log('false createData')
                })
            },

            showEditForm(data){
                this.statusModule('show');
                this.is_edit = true;
                this.fetchData(data);
            },

            fetchData(data) {
                this.$store.dispatch('fetchData',[this.url,data]).then(response => {
                    if (response.status == '200'){
                        // message
                        this.setForm(response.data);
                        this.statusModule('show');
                    }else{
                        console.log(response);
                    }
                }).catch(err => {
                    console.log('false fetchData')
                })
            },

            updateData() {
                this.$store.dispatch('updateData', [this.url+'/'+this.form.id,this.form])
                .then(response => {
                    if (response.status == '200'){
                        this.updateTable();
                        this.statusModule('hide');
                    }
                }).catch(err => {
                    console.log('false updateData')
                })
            },

            deleteData(data) {
                this.$store.dispatch('deleteData',[this.url,data]).then(response => {
                    if (response.status == '200'){
                        // message
                    }
                }).catch(err => {
                    console.log('false deleteData')
                })
            },

            sumit(){
                this.is_edit ?this.updateData() : this.createData();
            },
            
            statusModule(status){
                $('#myModal').modal(status);
            },
            
            setForm(data){
                this.form.id = data.data.id;
                this.form.title = data.data.title;
                this.form.content = data.data.content;
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
            }
        },
        computed: {
            ...mapGetters([ 'datas' ]),
            isValid() {
                return this.form.title !== '' && this.form.content !== '';
            }
        }
    }
</script>

<style scoped></style>
