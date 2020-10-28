<template>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Component ReferralName</div>
                    <div class="card-body"> I'm an component. </div>
                </div>
          </div> 
        </div> 
      </div>
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