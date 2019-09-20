<template>
    <nav class="navbar navbar-expand-md navbar-light">
        <router-link class="navbar-brand" to="/">
            <img src="../../../public/img/logo.png" alt="taxi2airport-logo"/>
        </router-link>
        <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
          <span
                  class="nav-link nav-link__profile dropdown-toggle"
                  id="userDropdown"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
          >
            <figure class="profile-pic">
              <img src="../../../public/img/logo.png" alt="username"/>
            </figure>
            <span class="profile-name">{{name}}</span>
          </span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <span class="dropdown-item" v-on:click="logOut">Logout</span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    import {mapState} from "vuex";

    export default {
        name: "Header",
        computed: mapState({
            name: state => state.authentication.name
        }),
        methods: {
            logOut() {
                this.$store.dispatch("authentication/logout", {
                    token: localStorage.getItem("token")
                });
            }
        }
    };
</script>
<style lang="scss" scoped>
    @import "../../sass/partials/partials";
    @import "~bootstrap/scss/mixins";
    @import "~bootstrap/scss/functions";
    @import "~bootstrap/scss/variables";

    .navbar-brand {
        width: ($sidebar-width * 1.3);
        margin: 0 0 0 (-$navbar-padding-x);
        text-align: center;

        img {
            height: $logo-size;
        }
    }

    .dropdown-item {
        cursor: pointer;
    }

    .navbar {
        .navbar-nav {
            .dropdown-menu {
                @include media-breakpoint-up(md) {
                    top: calc(#{$logo-size} + #{$navbar-brand-padding-y * 2});
                    margin: 0;
                    border-radius: 0;
                }
            }
        }
    }

    .nav-link {
        cursor: pointer;

        &__profile {
            display: flex;
            align-items: center;

            .profile-pic {
                margin: 0;
                width: $profile-size;
                height: $profile-size;
                border-radius: 100%;
                overflow: hidden;
                background-color: $body-bg;
                margin-right: ($grid-gutter-width / 3);

                img {
                    height: $profile-size;
                    object-fit: cover;
                }
            }

            .profile-name {
                margin-right: ($grid-gutter-width / 3);
            }
        }
    }
</style>
