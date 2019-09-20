<template>
    <section class="page">
        <header class="page__header bg-primary">
            <Header/>
        </header>
        <aside class="sidebar bg-dark">
            <Sidebar/>
        </aside>
        <main class="page__content mt-3 mt-sm-0">
            <router-view/>
        </main>
    </section>
</template>
<script>
    import Header from "../shared/TheHeader";
    import Sidebar from "../shared/TheSidebar";

    export default {
        name: 'Authenticated',
        components: {
            Sidebar,
            Header

        }
    }
</script>
<style lang="scss" scoped>
    @import "../../sass/partials/partials";
    @import "~bootstrap/scss/mixins";
    @import "~bootstrap/scss/functions";
    @import "~bootstrap/scss/variables";

    .page {
        display: flex;
        flex-wrap: wrap;
        min-height: 100vh;
        align-content: flex-start;

        &__header {
            @include flex-width(100%);
        }

        .sidebar {
            @include flex-width(100%);
            @include media-breakpoint-up(sm) {
                @include flex-width($sidebar-width);
                min-height: calc(100vh - #{$logo-size} - #{$navbar-padding-y * 2} - #{$navbar-brand-padding-y * 2});
            }
            @include media-breakpoint-up(xl) {
                @include flex-width($sidebar-width * 1.3);
            }
        }

        &__content {
            @include flex-width(100%);
            @include media-breakpoint-up(sm) {
                @include flex-width(calc(100% - #{$sidebar-width}));
                padding: $grid-gutter-width / 2;
            }
            @include media-breakpoint-up(lg) {
                padding: $grid-gutter-width ($grid-gutter-width * 2);
            }
            @include media-breakpoint-up(xl) {
                @include flex-width(calc(100% - #{$sidebar-width * 1.3}));
            }
        }
    }
</style>
<style lang="scss">
    @import "../../sass/partials/partials";
    @import "~bootstrap/scss/mixins";
    @import "~bootstrap/scss/functions";
    @import "~bootstrap/scss/variables";

    .inner-page {
        &__header {
            margin-bottom: ($grid-gutter-width / 2);
            padding: 0 ($grid-gutter-width / 2);
            @include media-breakpoint-up(lg) {
                margin-bottom: $grid-gutter-width;
            }
        }

        &__title {
            margin-bottom: 0;
            font-size: ($font-size-base * 1.75);
            font-weight: 600;
        }
    }
</style>
