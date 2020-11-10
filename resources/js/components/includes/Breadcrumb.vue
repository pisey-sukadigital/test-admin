<template>
    <div class="content-header pt-1 pb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                    {{ this.$route.meta.title}}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li v-for="(path, key) in this.$route.meta.path" :key="path"  class="breadcrumb-item">
                            <a v-if="(path_count -1 != key)" class="font-weight-bold" href="#">{{ path }}</a>
                            <span v-else>{{ path }}</span>
                        </li>
                    </ol>
                </div> 
            </div> 
        </div>
    </div>
</template>
<script>
    export default {
        name: 'Breadcrumb',
        data: function () {
            return {
                path_count: 0
            }
        },
        mounted() {
            this.path_count = (this.$route.meta.path ? this.$route.meta.path.length : 0);
        }
    }
</script>