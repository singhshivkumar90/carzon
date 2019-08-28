<template>
    <nav class="nav">
        <ul class="navbar p-0 m-0 flex-wrap">
            <li class="nav-item d-flex p-0 w-100">
                <router-link to="/dashboard" class="nav-link p-3 w-100 text-white"
                             :class="{ active: currentRouteName === 'dashboard' }">
                    <i class="nav-icon fa fa-bar-chart"></i> Dashboard
                </router-link>
            </li>
            <li class="nav-item d-flex p-0 w-100">
                <router-link to="/users" class="nav-link p-3 w-100 text-white" v-if="roleId === '1' || roleId === '3'"
                             :class="{ active: currentRouteName === 'user'}">
                    <i class="nav-icon fa fa-users"></i> User
                </router-link>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {
        name: "Sidebar",
        computed: {
            currentRouteName() {
                return this.$route.meta.moduleName;
            }
        },
        data() {
            return {
                roleId: localStorage.getItem('role')
            };
        },
    }
</script>

<style scoped lang="scss">
    @import "../../sass/partials/partials";
    @import "~bootstrap/scss/mixins";
    @import "~bootstrap/scss/functions";
    @import "~bootstrap/scss/variables";

    .nav {
        margin-top: ($grid-gutter-width / 6);

        .navbar {
            width: 100%;
        }

        &-link {
            border-left: ($border-width * 5) solid transparent;
            font-weight: 600;

            &.active {
                &,
                &:hover,
                &:focus {
                    border-color: $primary;
                }

                .nav-icon {
                    color: $primary;
                }
            }

            &:hover,
            &:focus {
                background-color: rgba($white, .1);
            }
        }
    }

</style>
