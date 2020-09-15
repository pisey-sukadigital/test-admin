<template>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Dashboard Component</div>
                    <div class="card-body"> I'm an Dashboard component. </div>
                </div>
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</template>

<script>
    export default {
        mounted() {
          this.$Progress.start()
          console.log('Component mounted.')
          this.$Progress.finish()
        }
    }
</script>
