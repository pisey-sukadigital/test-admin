<template>
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <table class="table table-bordered">
                    <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                    </tr>
                    @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <!-- <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td> -->
                        <td>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                        </td>
                        <td>
                         
                        </td>
                    </tr>
                    @endforeach
                    </table>
            </div>
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                })
            }
        },
        mounted() {
            this.fetchDatas();
        },
        methods: {
            fetchDatas() {
                this.$Progress.start()
                this.$store.dispatch('fetchDatas',this.url).then(response => {
                    if (response.status == '200'){
                        // message
                        this.$Progress.finish()
        
                    }
                }).catch(err => {
                    console.log('false fetchDatas')
                    this.$Progress.fail()
                })
            },
            createData() {

                // this.$store.dispatch('createData',['/api/users',this.form])
            
                this.form.post(this.url)
                 .then(({ data }) => { console.log(data) })
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