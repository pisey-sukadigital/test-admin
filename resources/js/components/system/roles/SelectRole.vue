<template>
    <div>
        <select multiple="multiple" id="roles" name="roles[]" class="form-control">
            <option v-for="item in items" :key="item.id">
                {{ item.name }}
            </option>
        </select>
    </div>
</template>
<script>
    export default {
        name: "select-all-role",
        props:[name],
        data() {
            return {
                url: "/api/roles/all",
                items:[],
                current_name:''

            }
        },
        mounted() {
            this.fetchDatas();
            this.current_name = name;
            console.log("this.current_name"+this.current_name);
        },
        methods: {
            fetchDatas() {
                axios.get(this.url)
                .then(response => {
                    this.items = response.data.data;
                }).catch(err => {
                    console.log("error select-all-role"); 
                });
            }
        }
    }
</script>