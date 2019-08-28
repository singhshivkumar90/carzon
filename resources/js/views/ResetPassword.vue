<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="password">Password</label>
            <input
                    type="password"
                    id="password"
                    v-model="password"
                    v-validate="{ required: true, min:6, max: 10 }"
                    name="password"
                    class="form-control"
                    ref="password"
                    data-vv-as="Password"
                    :class="{'input': true, 'is-invalid': errors.has('password') }"
            />
            <span v-show="errors.has('password')" class="text-danger">{{errors.first('password')}}</span>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm password</label>
            <input
                    type="password"
                    id="password_confirmation"
                    v-model="password_confirmation"
                    v-validate="{ required: true, min:6, max: 10,confirmed: 'password' }"
                    name="password_confirmation"
                    data-vv-as="Confirm Password"
                    class="form-control"
                    :class="{'input': true, 'is-invalid': errors.has('password_confirmation') }"
            />
            <span
                    v-show="errors.has('password_confirmation')"
                    class="text-danger"
            >{{errors.first('password_confirmation')}}</span>
        </div>
        <div class="form-group row">
            <div class="col-6">
                <button type="submit" class="btn btn-block btn-primary">
                    <SpinnerButton v-if="buttonLoading"/>
                    <span v-if="!buttonLoading">Submit</span></button>
            </div>
            <div class="col-6 text-right">
                <router-link to="/login" class="ml-auto btn btn-link">Cancel</router-link>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapState} from "vuex";
    import SpinnerButton from "../components/SpinnerButton";

    export default {
        name: "ResetPassword",
        components: {SpinnerButton},
        data() {
            return {
                password: "",
                password_confirmation: "",
                token: this.$route.query.token,
                email: this.$route.query.email
            };
        },
        computed: mapState({
            buttonLoading: state => state.authentication.buttonLoading
        }),
        methods: {
            handleSubmit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        this.$store.dispatch("authentication/resetPassword", {
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.password_confirmation,
                            token: this.token
                        });
                    }
                });
            }
        }
    };
</script>
