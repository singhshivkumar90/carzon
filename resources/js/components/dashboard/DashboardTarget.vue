<template>
    <div class="col-12 col-lg-6 col-xl-4 mb-3">
        <div class="card h-100 text-center" v-if="monthlyTargetLoader">
            <b-spinner label="Spinning" variant="warning"></b-spinner>
        </div>
        <div class="card h-100" v-if="!monthlyTargetLoader">
            <div class="card-header font-weight-bold d-flex align-items-center justify-content-between">
                <div class="card-header-title">Bookings Target (Monthly)</div>
            </div>
            <div class="card-body">
                <div class="h4 text-center">Countdown</div>
                <div class="h3 text-center text-danger">{{countdownTimer}}</div>
                <div class="chart-wrapper">
                    <doughnut-chart :data="monthlyTarget" :options="monthlyTargetOptions"></doughnut-chart>
                    <div class="h4 text-center">{{monthlyTargetAchieved.targetAchieved}}% <span
                            class="d-block">Achieved</span></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";
    import DoughnutChart from "../DoughnutChart";

    export default {
        name: "DashboardTarget",
        components: {
            DoughnutChart
        },
        data() {
            return {
                monthlyTargetOptions: {
                    rotation: Math.PI,
                    circumference: Math.PI
                },
                countdownTimer: '',
            }
        },
        created() {
            let today = new Date();
            let countdownDate = new Date(today.getFullYear(), today.getMonth() + 1, 0).getTime();
            window.setInterval(() => {
                let now = new Date().getTime();
                let distance = countdownDate - now;
                // Time calculations for days, hours, minutes and seconds
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                this.countdownTimer = `${days}d : ${hours}h : ${minutes}m : ${seconds}s`;
            }, 1000);
            this.$store.dispatch('report/getMonthlyTarget');
        },
        computed: mapState({
            monthlyTargetLoader: state => state.report.monthlyTargetLoader,
            monthlyTargetAchieved: state => state.report.monthlyTarget,
            monthlyTarget(state) {
                return {
                    labels: ["Achieved", "Remaining"],
                    datasets: [
                        {
                            label: "Data One",
                            backgroundColor: ["#FFCC33"],
                            data: [state.report.monthlyTarget.targetAchieved, 100 - state.report.monthlyTarget.targetAchieved],
                        }
                    ]
                }
            }
        }),
    }
</script>
