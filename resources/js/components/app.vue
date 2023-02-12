<template>
    <v-app :class="getState">
        <Header v-if="authentication"></Header>
        <v-main>
            <Index v-if="authentication === false"></Index>
            <router-view v-if="authentication"></router-view>
        </v-main>
        <Footer></Footer>
    </v-app>
</template>

<script>
//import ServerBus from '../eventBus';
import Index from "./views/index.vue";
import Header from "./header.vue";
import Footer from "./footer.vue";

export default {
    components: { Index, Header, Footer },
    name: "app",

    data() {
        return {
            authentication: null,
        };
    },

    computed: {
        getState() {
            const Self = this;
            this.$store.dispatch('setLogin', function() {
                Self.authentication = Self.$store.getters.isUserLogged;

                if (!Self.authentication) {
                    Self.$router.push("/").catch((err) => err);
                }
                if (Self.authentication && window.location.pathname == "/") {
                    Self.$router.push("/home").catch((err) => err);
                }
            });
        },
    },

    created() {

    },

    mounted() {
        this.authentication = this.$store.getters.isUserLogged;
        return this.authentication ? "user-logged" : "user-anonymous";
        
    },

    methods: {
    },
};
</script>
