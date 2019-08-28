<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text"
                   v-model="email"
                   name="email"
                   v-validate="'required|email'"
                   id="email"
                   class="form-control"
                   data-vv-as="Email"
                   :class="{'input': true, 'is-invalid': errors.has('email') }"
            >
            <span v-show="errors.has('email')" class="text-danger">{{errors.first('email')}}</span>
        </div>
        <div class="form-group row">
            <div class="col-6">
                <button type="submit"
                        class="btn btn-block btn-primary"
                >
                    <SpinnerButton v-if="buttonLoading"/>
                    <span v-if="!buttonLoading">Reset Password</span>
                </button>
            </div>
            <div class="col-6 text-right">
                <router-link to="/login" class="ml-auto btn btn-link"><i class="fa fa-angle-left mr-2"></i>
                    Back to login
                </router-link>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapState} from "vuex";
    import SpinnerButton from "../components/SpinnerButton";

    export default {
        name: "ForgotPassword",
        components: {SpinnerButton},
        data() {
            return {
                email: ""
            };
        },
        computed: mapState({
            buttonLoading: state => state.authentication.buttonLoading
        }),
        methods: {
            handleSubmit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        this.$store.dispatch("authentication/forgotPassword", {
                            email: this.email
                        });
                    }
                });
            }
        }
    };
</script>


