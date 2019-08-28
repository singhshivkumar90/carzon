import Vue from 'vue';
import Vuex from 'vuex';
import authentication from './module/authentication';
import user from "./module/user";
import report from "./module/report";

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    strict: false,
    modules: {
        authentication,
        user,
        report
    }
});
