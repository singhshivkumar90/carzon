<template>
    <div class="inner-page">
        <header class="inner-page__header d-flex justify-content-between align-items-center">
            <h1 class="inner-page__title">{{id ? 'Edit User' : 'Add User'}}</h1>
        </header>
        <section class="inner-page__content container-fluid">
            <!-- Add user form -->
            <div class="row mb-3">
                <div class="col-12">
                    <form @submit.prevent="userFormSubmit">
                        <div class="card">
                            <div class="text-center" v-if="loading">
                                <b-spinner label="Spinning" variant="warning"></b-spinner>
                            </div>
                            <div class="card-body" v-if="!loading">
                                <div class="row justify-content-center">
                                    <div class="col-xl-9 p-4 py-xl-5">
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-lg-6 col-xl-5">

                                                <div class="form-group">
                                                    <label for="firstName">
                                                        First Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                           id="firstName"
                                                           v-model="firstName"
                                                           name="firstName"
                                                           v-validate="'required|alpha_spaces|min:1|max:50'"
                                                           class="form-control"
                                                           data-vv-as="First name"
                                                           :class="{'input': true, 'is-invalid': errors.has('firstName') }"
                                                    >
                                                    <span v-show="errors.has('firstName')"
                                                          class="text-danger">{{errors.first('firstName')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-xl-5">
                                                <div class="form-group">
                                                    <label for="lastName">
                                                        Last Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                           id="lastName"
                                                           v-model="lastName"
                                                           name="lastName"
                                                           v-validate="'required|alpha_spaces|min:1|max:50'"
                                                           class="form-control"
                                                           data-vv-as="Last name"
                                                           :class="{'input': true, 'is-invalid': errors.has('lastName') }"
                                                    >
                                                    <span v-show="errors.has('lastName')"
                                                          class="text-danger">{{errors.first('lastName')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-xl-5">
                                                <div class="form-group">
                                                    <label for="email">
                                                        Email
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="email"
                                                           id="email"
                                                           v-model="email"
                                                           name="email"
                                                           v-validate="'required|email'"
                                                           class="form-control"
                                                           data-vv-as="Email"
                                                           :class="{'input': true, 'is-invalid': errors.has('email') }"
                                                    >
                                                    <span v-show="errors.has('email')"
                                                          class="text-danger">{{errors.first('email')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-xl-5" v-if="!id">
                                                <div class="form-group">
                                                    <label>
                                                        Password
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password"
                                                           id="password"
                                                           v-model="password"
                                                           name="password"
                                                           v-validate="'required|min:6|max:10'"
                                                           class="form-control"
                                                           data-vv-as="Password"
                                                           :class="{'input': true, 'is-invalid': errors.has('password') }"
                                                    >
                                                    <span v-show="errors.has('password')"
                                                          class="text-danger">{{errors.first('password')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 col-xl-5">
                                                <div class="form-group">
                                                    <label for="role">
                                                        Role
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select id="role" v-model="role" name="role" v-validate="'required'"
                                                            data-vv-as="Role"
                                                            :disabled="id === loggedInUserId"
                                                            class="form-control">
                                                        <option disabled value="">Select a role</option>
                                                        <option v-for="roleOption in options"
                                                                :selected="role === roleOption.id"
                                                                :key="roleOption.id"
                                                                :value="roleOption.id"
                                                        >{{ roleOption.name }}
                                                        </option>
                                                    </select>
                                                    <span v-show="errors.has('role')" class="text-danger">
                                                {{ errors.first('role') }}
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <button type="submit" class="mt-2 btn btn-success">
                                                    <SpinnerButton v-if="buttonLoading"/>
                                                    <span v-if="!buttonLoading">{{id ? 'Update User' : 'Add User'}}</span>
                                                </button>
                                                <router-link to="/users" class="mt-2 btn btn-outline-danger">CANCEL
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import {mapState} from "vuex";
    import SpinnerButton from "../components/SpinnerButton";

    export default {
        name: "UserForm",
        components: {
            SpinnerButton
        },
        data() {
            return {
                id: this.$route.params.id,
                firstName: '',
                lastName: '',
                email: '',
                password: '',
                role: '',
                loggedInUserId: localStorage.getItem('userId'),
                options: [
                    {
                        id: 1,
                        name: "admin"
                    },
                    {
                        id: 2,
                        name: "employee"
                    }

                ]
            };
        },
        computed: mapState({
            loading: state => state.user.loading,
            buttonLoading: state => state.user.buttonLoading
        }),
        created() {
            if (this.id) {
                this.getUserInformation(this.id);
            }
        },
        methods: {
            getUserInformation(userID) {
                this.$store.dispatch('user/getUserData', userID).then((result) => {
                    this.firstName = result.firstName;
                    this.lastName = result.lastName;
                    this.email = result.email;
                    this.role = result.roleId;
                });
            },
            userFormSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        const actionName = this.id ? 'user/editUser' : 'user/addUser';
                        this.$store.dispatch(actionName, {
                            'firstName': this.firstName,
                            'lastName': this.lastName,
                            'email': this.email,
                            'password': this.password,
                            'role': this.role,
                            'id': this.id
                        })
                    }
                });
            }
        }
    };
</script>
