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
            <span v-show="errors.has('email')"
                  class="text-danger">{{errors.first('email')}}</span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   id="password"
                   v-model="password"
                   name="password"
                   v-validate="'required'"
                   class="form-control"
                   data-vv-as="Password"
                   :class="{'input': true, 'is-invalid': errors.has('password') }"
            >
            <span v-show="errors.has('password')"
                  class="text-danger">{{errors.first('password')}}</span>
        </div>
        <div class="form-group text-right">
            <router-link to="/forgot-password">Forgot password?</router-link>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">
                <SpinnerButton v-if="buttonLoading"/><span v-if="!buttonLoading">Login</span>
            </button>
        </div>
    </form>
</template>

<script>
    import {mapState} from "vuex";
    import SpinnerButton from "../components/SpinnerButton";

    export default {
        name: "Login",
        components: {SpinnerButton},
        data() {
            return {
                email: "",
                password: ""
            };
        },
        computed: mapState({
            buttonLoading: state => state.authentication.buttonLoading
        }),
        methods: {
            handleSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$store.dispatch('authentication/login', {
                            'email': this.email,
                            'password': this.password
                        })
                    }
                });
            }
        }
    };
</script>
