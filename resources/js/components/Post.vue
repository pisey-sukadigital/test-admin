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
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data in datas.data" :key="data.id">
                            <td>{{data.title}}</td>
                            <td>{{data.content}}</td>
                            <td>
                                <button class="btn btn-danger" @click="deleteData(data)"><i style="color:white" class="fa fa-trash"></i></button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Post creation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="ml-2 mr-2" enctype="multipart/form-data"
                 @submit="createData(form)" @keydown="form.onKeydown($event)">
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Post title" v-model="form.title" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea v-model="form.content" name="content" placeholder="Post content" class="form-control">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <button :disabled="!isValid" class="btn btn-block btn-primary" 
                        @click.prevent="createData(form)">Submit</button>
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
        name: "posts",
        data() {
            return {
                form: new Form({
                    title: '',
                    content: ''
                })
            }
        },
        mounted() {
            this.$store.dispatch('fetchDatas','/api/posts')
        },
        methods: {
            deleteData(data) {
                this.$store.dispatch('deleteData',['/api/posts',data])
            },
            createData(data) {
                this.$store.dispatch('createData',['/api/posts',data])
            }
        },
        computed: {
            ...mapGetters([
                'datas'
            ]),
            isValid() {
                return this.form.title !== '' && this.form.content !== '';
            }
        }
    }
</script>

<style scoped>

</style>
