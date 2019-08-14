<template>
    <div class="col-12 col-lg-6 col-xl-4 mb-3">
        <div class="card h-100 text-center">
            <div class="card-header font-weight-bold d-flex align-items-center justify-content-between">
                <div class="card-header-title">Booking</div>
                <div>
                    <select class="form-control" @change="onBookingFilterChange($event)">
                        <option value="today" :selected="'today' === bookingFilter">Today</option>
                        <option value="week" :selected="'week' === bookingFilter">This Week</option>
                        <option value="month" :selected="'month' === bookingFilter">This Month</option>
                        <option value="quarter" :selected="'quarter' === bookingFilter">This Quarter
                        </option>
                    </select>
                </div>
            </div>
            <div class="h-100 text-center" v-if="bookingLoader">
                <b-spinner label="Spinning" variant="warning"></b-spinner>
            </div>
            <div class="card-body" v-if="!bookingLoader">
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item text-capitalize">{{booking.firstSet.key}} <span
                            class="d-block text-success">{{booking.firstSet.value}}</span></li>
                    <li class="list-group-item text-capitalize">{{booking.secondSet.key}} <span
                            class="d-block text-success">{{booking.secondSet.value}}</span>
                    </li>
                    <li class="list-group-item text-capitalize">{{booking.thirdSet.key}} <span
                            class="d-block text-success">{{booking.thirdSet.value}}</span>
                    </li>
                    <li class="list-group-item text-capitalize">{{booking.fourthSet.key}}<span
                            class="d-block text-success">{{booking.fourthSet.value}}</span></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";

    export default {
        name: "DashboardBooking",
        data() {
            return {
                bookingFilter: 'today',
            }
        },
        created() {
            this.$store.dispatch('report/getBookings');
        },
        methods: {
            onBookingFilterChange(event) {
                this.bookingFilter = event.target.value;
                this.$store.dispatch('report/getBookings', event.target.value);
            }
        },
        computed: mapState({
            booking: state => state.report.booking,
            bookingLoader: state => state.report.bookingLoader,
        }),
    }
</script>
