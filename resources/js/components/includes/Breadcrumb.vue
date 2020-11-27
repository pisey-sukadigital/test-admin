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

                        <template v-if="(this.$route.meta.path.length > 1)">
                            <li v-for="(path, key) in this.$route.meta.path" :key="path"  class="breadcrumb-item">
                                <router-link v-if="key == 0" :to="'/dashboard'" class="font-weight-bold"> {{ path }} </router-link>
                                <a v-else-if="key == 1" class="font-weight-bold" href="#">{{ path }}</a>
                                <span v-else-if="key == 2">{{ path }} </span>
                            </li>
                        </template>

                        <template v-else>
                            <li v-for="(path, key) in this.$route.meta.path" :key="path"  class="breadcrumb-item">
                                <span>{{ path }} </span>
                            </li>
                        </template> 
                    </ol>
                </div> 
            </div> 
        </div>
    </div>
</template>
<script>
    export default {
        name: 'Breadcrumb',
    }
</script>