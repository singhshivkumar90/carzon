<template>
    <section class="anonymous-container container-fluid">
        <div class="row vh-100">
            <div class="col-1 col-lg-8 m-auto ml-lg-auto ml-lg-0 anonymous-container__bg"></div>
            <div class="col-10 col-lg-4 m-auto ml-lg-auto mr-lg-0 anonymous-container__col">
                <div class="row vh-100 align-content-center flex-nowrap flex-column bg-white">
                    <div class="m-auto w-100 p-3 p-sm-4">
                        <article class="anonymous-container__form">
                            <figure class="anonymous-container__logo">
                                <img src="../../../public/img/logo.png" alt="">
                            </figure>
                            <router-view></router-view>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'Anonymous',
    }
</script>

<style lang="scss" scoped>
    @import "../../sass/partials/partials";
    @import "~bootstrap/scss/mixins";
    @import "~bootstrap/scss/functions";
    @import "~bootstrap/scss/variables";

    .anonymous-container {
        &__bg {
            background-image: url("../../../public/img/login-bg.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: left center;
            height: 100%;
            position: relative;
        }

        &__form {
            margin: 0 auto;
            max-width: 350px;

            .btn {
                &:not(.btn-link) {
                    color: $white;
                    font-weight: $font-weight-bold;
                }
            }
        }

        &__logo {
            margin: 0 auto $grid-gutter-width;

            img {
                width: 100%;
            }
        }
    }
</style>
