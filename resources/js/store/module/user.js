import * as Vue from "vue";
import {router} from '../../_helpers';

// Initial state
const state = {
    users: [],
    currentPage: 1,
    count: 0,
    perPage: 15,
    total: 0,
    totalPages: 0,
    loading: false,
    buttonLoading: false
};

// actions
const actions = {
    /**
     * Get user list
     *
     * @param commit
     * @param page
     */
    getUsers({commit}, page = 0) {
        commit('startLoader');
        const url = page ? `/api/v1/users?page=${page}` : `/api/v1/users`;
        axios.get(url).then(result => {
            commit('userRequestSuccess', {users: result.data.data.users, pagination: result.data.data.pagination});
        }).catch(() => {
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
     * @param id
     */
    getUserData({commit}, id) {
        commit('startLoader');
        return new Promise((resolve, reject) => {
            axios.get(`/api/v1/users/${id}`).then(result => {
                resolve(result.data.data);
            }).catch(() => {
                if (error.response) {
                    Vue.toasted.show(error.response.data.message, {
                        type: 'error'
                    });
                }
                reject();
            }).finally(() => {
                commit('stopLoader');
            });
        });
    },
    /**
     * Call add user API
     *
     * @param commit
     * @param userData
     */
    addUser({commit}, userData) {
        commit('startButtonLoader');
        axios.post(`/api/v1/users`, {
            first_name: userData.firstName,
            last_name: userData.lastName,
            email: userData.email,
            password: userData.password,
            role: userData.role
        }).then(result => {
            Vue.toasted.show(result.data.message, {
                type: 'success'
            });
            router.push({path: "/users"});
        }).catch((error) => {
            if (error.response) {
                Vue.toasted.show(error.response.data.errors.email, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopButtonLoader');
        });
    },
    /**
     * Call edit user API
     *
     * @param commit
     * @param id
     * @param userData
     */
    editUser({commit}, userData) {
        commit('startButtonLoader');
        axios.put(`/api/v1/users/${userData.id}`, {
            first_name: userData.firstName,
            last_name: userData.lastName,
            email: userData.email,
            password: userData.password,
            role: userData.role
        }).then(result => {
            Vue.toasted.show(result.data.message, {
                type: 'success'
            });
            if (userData.id === localStorage.getItem('userId')) {
                localStorage.setItem('name', (`${userData.firstName} ${userData.lastName}`));
                commit('authentication/setName', `${userData.firstName} ${userData.lastName}`, { root: true });
            }
            router.push({path: "/users"});
        }).catch((error) => {
            if (error.response) {
                Vue.toasted.show(error.response.data.errors.email, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopButtonLoader');
        });
    },
    /**
     * Call delete user API
     *
     * @param commit
     * @param dispatch
     * @param id
     */
    deleteUser({commit, dispatch}, id) {
        Vue.swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                commit('startLoader');
                axios.delete(`/api/v1/users/${id}`).then(result => {
                    Vue.toasted.show(result.data.message, {
                        type: 'success'
                    });
                    dispatch('getUsers').then(() => {
                        Vue.swal(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                        )
                    });
                }).catch(() => {
                    if (error.response) {
                        Vue.toasted.show(error.response.data.message, {
                            type: 'error'
                        });
                    }
                });
            }
        });
    }
};

const mutations = {
    startLoader(state) {
        state.loading = true;
    },
    startButtonLoader(state) {
        state.buttonLoading = true;
    },
    userRequestSuccess(state, payload) {
        state.users = payload.users;
        state.userListPagination = payload.pagination;
        state.currentPage = payload.pagination.current_page;
        state.perPage = payload.pagination.per_page;
        state.total = payload.pagination.total;
    },
    stopLoader(state) {
        state.loading = false;
    },
    stopButtonLoader(state) {
        state.buttonLoading = false;
    }
};

export default {
    namespaced: true,
    state,
    actions,
    mutations
}
