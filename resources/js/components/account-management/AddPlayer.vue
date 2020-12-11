<template>
    <div class="content">
      <div class="container-fluid">
        <form v-on:submit.prevent="submit">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                        <h6 class="mb-0 text-bold">Account info</h6> 
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="Loginid" class="col-sm-2 col-form-label">Company ID  :</label>
                                <div class="col-sm-4">
                                    <select class="custom-select" id="company_id">
                                        <option value="compan_a">compan A</option>
                                        <option value="compan_b">compan B</option>
                                        <option value="compan_c">compan C</option>
                                        <option value="compan_d">compan D</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 my-auto">
                                    <small id="passwordHelpInline" class="text-muted"> Man 3 characters</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Loginid" class="col-sm-2 col-form-label">Login ID* :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="Loginid" placeholder="LoginID" autocomplete="off">
                                </div>
                                <div class="col-sm-4 my-auto">
                                    <small id="passwordHelpInline" class="text-muted"> Min 6 characters</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password  :</label>
                                <div class="col-sm-4"> 
                                    <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                                </div>
                                <div class="col-sm-4 my-auto">
                                    <small id="passwordHelpInline" class="text-muted"> Min 6 characters</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status :</label>
                                <div class="col-sm-4">
                                    <select class="custom-select" id="status">
                                        <option value="1">Unlock</option>
                                        <option value="0">Lock</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>
                </div> 
            </div> 

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                        <h6 class="mb-0 text-bold">Data info</h6> 
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label for="Loginid" class="col-sm-2 col-form-label">Email :</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" id="email" placeholder="Email" autocomplete="off">
                                    </div>
                                </div>
                        </div>
                        </div>
                </div> 
            </div> 

            <div class="row pb-5">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
      </div>
    </div>
</template>

<script>
    export default {
        methods: {
            submit: function(e) {
                alert('Send method!');
            }
        }
    }
</script>