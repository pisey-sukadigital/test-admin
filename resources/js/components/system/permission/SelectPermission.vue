<template>
    <div>
        <select class="custom-select" id="companyId">
            <option value="0">C01 {{ body }}</option>
            <option value="1">C02</option>
            <option value="2">C03</option>
            <option value="3">C04</option>
            <option value="4">C05</option>
        </select>
    </div>
</template>
<script>

    import {mapGetters} from 'vuex'

    export default {
        name: "select-company",
        props: ['message'],
        data() {
            return {
                url: "/api/company",
                body: this.message 
            }
        },
        mounted() {
            console.log("Mounted Select compnay");
            this.fetchDatas();
        },
        methods: {
            fetchDatas() {
                this.$Progress.start()
                this.$store.dispatch('fetchDatas',this.url).then(response => {
                    if (response.status == '200'){
                        // message
                        console.log(response.data.data);
                        this.$Progress.finish()
                    }
                }).catch(err => {
                    console.log('false fetchDatas')
                    this.$Progress.fail()
                })
            }
        },
        computed: {
            ...mapGetters([ 'datas'])
        }
    }
</script>