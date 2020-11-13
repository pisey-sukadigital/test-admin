<template>
    <div v-if="$can(name)" class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-default card-primary card-outline">
                <div class="card-header">Dashboard Component</div>
                    <div class="card-body"> I'm an Dashboard component. </div>
                </div>
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div v-else>
        <div class="text-center mt-2 pt-2 pb-2 bg-danger">
          <h2>Permission denied</h2>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'system-log-activity',
                url: "/api/posts",
                is_edit: false,
                form: new Form({ id: '', title: '', content: '' }),
                laravelData: {}, 
            }
        },
        mounted() {
          this.$Progress.start()
          console.log('logActivty Component mounted.')
          //  console.log(window.Permissions);
          this.$Progress.finish()
        }
    }
</script>