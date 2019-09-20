import * as Vue from "vue";
import {router} from '../../_helpers';
// initial state

const state = {
    token: localStorage.getItem('token'),
    buttonLoading: false,
    name: localStorage.getItem('name')
};

// actions
const actions = {
    /**
     * Call login API
     *
     * @param commit
     * @param state
     * @param email
     * @param password
     */
    login({commit, dispatch}, {email, password}) {
        commit('startLoader');
        axios.post(`/api/v1/login`, {email, password}).then(result => {
            Vue.toasted.show(result.data.message, {
                type: 'success'
            });
            commit('loginSuccess', result.data.data.token);
            localStorage.setItem('token', result.data.data.token);
            dispatch('getUserInformation');
        }).catch(error => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopLoader');
        });
    },
    /**
     * Call get user information API
     *
     * @param commit
     */
    getUserInformation({commit}) {
        axios.get(`/api/v1/user`).then(result => {
            commit('setName', (`${result.data.data.user.first_name} ${result.data.data.user.last_name}`));
            localStorage.setItem('name', (`${result.data.data.user.first_name} ${result.data.data.user.last_name}`));
            localStorage.setItem('role', result.data.data.role.id);
            localStorage.setItem('userId', result.data.data.user.id);
            router.push({path: "/dashboard"});
        }).catch(() => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        });
    },
    /**
     * Call reset password API
     *
     * @param commit
     * @param email
     * @param password
     * @param password_confirmation
     * @param token
     */
    resetPassword({commit}, {email, password, password_confirmation, token}) {
        commit('startLoader');
        axios.post(`/api/v1/reset-password`, {
            email,
            password,
            password_confirmation,
            token
        }).then(result => {
            Vue.toasted.show(result.data.data.success, {
                type: 'success'
            });
            router.push({path: "/login"});
        }).catch(error => {
            if (error.response) {
                Vue.toasted.show(error.response.data.data.error, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopLoader');
        })
    },
    /**
     * Call forgot password API
     *
     * @param commit
     * @param email
     */
    forgotPassword({commit}, {email,}) {
        commit('startLoader');
        axios.post(`/api/v1/forgot-password`, {email}).then((result) => {
            Vue.toasted.show(result.data.data.message, {
                type: 'success'
            });
            router.push({path: "/login"});
        }).catch(error => {
            if (error.response) {
                Vue.toasted.show(error.response.data.data.error, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopLoader');
        });
    },
    /**
     * Call logout API
     *
     * @param token
     */
    logout({token}) {
        axios.post(`/api/v1/logout`, {token}).then((result) => {
            state.token = null;
            localStorage.removeItem('token');
            localStorage.removeItem('name');
            localStorage.removeItem('role');
            localStorage.removeItem('userId');
            Vue.toasted.show(result.data.message, {
                type: 'success'
            });
            router.push({path: '/login'})
        })
    }
};

const mutations = {
    startLoader(state) {
        state.buttonLoading = true;
    },
    loginSuccess(state, payload) {
        state.buttonLoading = false;
        state.token = payload;
    },
    setName(state, payload) {
        state.name = payload
    },
    stopLoader(state) {
        state.buttonLoading = false;
    }
};

const getters = {
    token: state => state.token
};

export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters
}
