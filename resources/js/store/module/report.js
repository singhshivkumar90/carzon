import * as Vue from "vue";

// Initial state
const state = {
    loading: false,
    bookingLoader: false,
    booking: {},
    ticketLoader: false,
    tickets: {},
    todoLoader: false,
    todos: {},
    monthlyTargetLoader: false,
    monthlyTarget: {},
    chartLoader: false,
    chartReports: {}
};

// actions
const actions = {
    /**
     * Get booking details
     * @param commit
     * @param filter
     */
    getBookings({commit}, filter = '') {
        commit('startBookingLoader');
        const url = filter ? `/api/v1/bookings?with=${filter}` : `/api/v1/bookings/`;
        axios.get(url).then(result => {
            commit('bookingRequestSuccess', result.data.data);
        }).catch(() => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopBookingLoader');
        });
    },
    /**
     * Call tickets API
     *
     * @param commit
     */
    getTickets({commit}) {
        commit('startTicketLoader');
        axios.get(`/api/v1/tickets`).then(result => {
            commit('ticketRequestSuccess', result.data.data);
        }).catch(() => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopTicketLoader');
        });
    },
    /**
     * Call todos API
     *
     * @param commit
     */
    getTodos({commit}) {
        commit('startTodoLoader');
        axios.get(`/api/v1/to-dos`).then(result => {
            commit('todoRequestSuccess', result.data.data);
        }).catch(() => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopTodoLoader');
        });
    },
    /**
     * Call monthly target API
     *
     * @param commit
     */
    getMonthlyTarget({commit}) {
        commit('startMonthlyTargetLoader');
        axios.get(`/api/v1/monthly-target`).then(result => {
            commit('monthlyTargetRequestSuccess', result.data.data);
        }).catch(() => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopMonthlyTargetLoader');
        });
    },
    /**
     * Call charts API
     *
     * @param commit
     */
    getCharts({commit}) {
        commit('startChartLoader');
        axios.get(`/api/v1/chart-reports`).then(result => {
            commit('chartRequestSuccess', result.data.data);
        }).catch(() => {
            if (error.response) {
                Vue.toasted.show(error.response.data.message, {
                    type: 'error'
                });
            }
        }).finally(() => {
            commit('stopChartLoader');
        });
    }

};

const mutations = {
    startBookingLoader(state) {
        state.bookingLoader = true;
    },
    stopBookingLoader(state) {
        state.bookingLoader = false;
    },
    bookingRequestSuccess(state, payload) {
        state.booking = payload;
    },
    startTicketLoader(state) {
        state.ticketLoader = true;
    },
    ticketRequestSuccess(state, payload) {
        state.tickets = payload;
    },
    stopTicketLoader(state) {
        state.ticketLoader = false;
    },
    startTodoLoader(state) {
        state.todoLoader = true;
    },
    todoRequestSuccess(state, payload) {
        state.todos = payload;
    },
    stopTodoLoader(state) {
        state.todoLoader = false;
    },
    startMonthlyTargetLoader(state) {
        state.monthlyTargetLoader = true;
    },
    monthlyTargetRequestSuccess(state, payload) {
        state.monthlyTarget = payload;
    },
    stopMonthlyTargetLoader(state) {
        state.monthlyTargetLoader = false;
    },
    startChartLoader(state) {
        state.chartLoader = true;
    },
    chartRequestSuccess(state, payload) {
        state.chartReports = payload;
    },
    stopChartLoader(state) {
        state.chartLoader = false;
    }
};

export default {
    namespaced: true,
    state,
    actions,
    mutations
}
