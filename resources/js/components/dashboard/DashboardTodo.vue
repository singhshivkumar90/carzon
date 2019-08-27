<template>
    <div class="col-12 col-lg-6 col-xl-12 mb-3">
        <div class="card h-100 text-center" v-if="todoLoader">
            <b-spinner label="Spinning" variant="warning"></b-spinner>
        </div>
        <div class="card h-100" v-if="!todoLoader">
            <div class="card-header font-weight-bold d-flex align-items-center justify-content-between">
                <div class="card-header-title">TO-DOs</div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="h4 text-center">Today</div>
                        <div class="h3 text-center text-info">{{todos.pendingToDoCount}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";

    export default {
        name: "DashboardTodo",
        created() {
            this.$store.dispatch('report/getTodos');
        },
        computed: mapState({
            todos: state => state.report.todos,
            todoLoader: state => state.report.todoLoader,
        }),
    }
</script>
