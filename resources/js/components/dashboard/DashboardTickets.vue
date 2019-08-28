<template>
    <div class="col-12 col-lg-6 col-xl-12 mb-3">
        <div class="card h-100 text-center" v-if="ticketLoader">
            <b-spinner label="Spinning" variant="warning"></b-spinner>
        </div>
        <div class="card h-100" v-if="!ticketLoader">
            <div class="card-header font-weight-bold d-flex align-items-center justify-content-between">
                <div class="card-header-title">CS Tickets</div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="h4 text-center">Today</div>
                        <div class="h3 text-center text-warning">{{tickets.today}}</div>
                    </div>
                    <div class="col-6 text-center h6">
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item p-1">
                                Last week - {{day}}
                                <span class="d-block text-warning">
                                    {{tickets.thisDayLastWeek}}
                                </span>
                            </li>
                            <li class="list-group-item p-1">
                                Yesterday
                                <span class="d-block text-warning">
                                    {{tickets.yesterday}}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";

    export default {
        name: "DashboardTickets",
        data() {
            return {
                day: new Date().toLocaleString('en-us', {weekday: 'short'})
            }
        },
        created() {
            this.$store.dispatch('report/getTickets');
        },
        computed: mapState({
            tickets: state => state.report.tickets,
            ticketLoader: state => state.report.ticketLoader,
        }),
    }
</script>
