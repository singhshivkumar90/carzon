<template>
    <div class="inner-page">
        <header class="inner-page__header d-flex justify-content-between align-items-center">
            <h1 class="inner-page__title">Overview</h1>
        </header>
        <section class="inner-page__content container-fluid">
            <div class="row">
                <DashboardBooking/>
                <DashboardTarget/>
                <div class="col-12 col-xl-4">
                    <div class="row">
                        <DashboardTickets/>
                        <DashboardTodo/>
                    </div>
                </div>
            </div>
            <template v-if="role === 1 || role === 3">
                <DashboardPerformance/>
            </template>
        </section>
    </div>
</template>
<script>
    import DoughnutChart from "../components/DoughnutChart";
    import DashboardBooking from "../components/dashboard/DashboardBooking";
    import DashboardTarget from "../components/dashboard/DashboardTarget";
    import DashboardPerformance from "../components/dashboard/DashboardPerformance";
    import DashboardTickets from "../components/dashboard/DashboardTickets";
    import DashboardTodo from "../components/dashboard/DashboardTodo";

    export default {
        name: "Dashboard",
        components: {
            DashboardTodo,
            DashboardTickets,
            DashboardPerformance,
            DashboardTarget,
            DashboardBooking,
            DoughnutChart
        },
        data() {
            return {
                role: parseInt(localStorage.getItem('role'))
            }
        }
    }
</script>
