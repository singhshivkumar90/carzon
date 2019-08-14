<template>
    <section class="page">
        <header class="page__header bg-primary">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="#">
                    <img src="../../../public/img/logo.png" alt="taxi2airport-logo"/>
                </a>
            </nav>
        </header>
        <section class="page-404 text-center p-3 p-sm-4 p-md-5">
            <h2 class="text-danger">This page isn't available</h2>
            <i class="my-4 page-404__icon fa fa-chain-broken"></i>
            <h6>The link you followed may be broken, or the page may have been removed.</h6>
            <router-link to="/">
                <a class="btn btn-success mt-4"><i class="fa fa-angle-left mr-2"></i> Go to previous page</a>
            </router-link>
        </section>
    </section>
</template>

<script>
    export default {
        name: 'PageNotFound'
    };
</script>

<style lang="scss" scoped>
    @import "../../sass/partials/partials";
    @import "~bootstrap/scss/mixins";
    @import "~bootstrap/scss/functions";
    @import "~bootstrap/scss/variables";

    .page {
        min-height: 100vh;

        &-404 {
            &__icon {
                font-size: ($font-size-base * 3);
            }
        }
    }

    .navbar-brand {
        width: $sidebar-width;
        margin: 0 0 0 (-$navbar-padding-x);
        text-align: center;

        img {
            height: $logo-size;
        }
    }
</style>
