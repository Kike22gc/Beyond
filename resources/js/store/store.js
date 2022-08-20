import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";
import axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        authentication: false,
        user_id: null,
        user_name: null,
        user_mail: null,
        user_team: null,
    },
    mutations: {
        LOGIN: async function (state, callback) {
            let response = await axios.get("/api/user/data");

            if (response.data.status == 'OK') {
                state.authentication = true;
                state.user_id = response.data.id;
                state.user_name = response.data.name;
                state.user_mail = response.data.email;
                state.user_team = response.data.team;
                if (typeof callback == 'function') {
                    callback(true);
                }
            } else {
                state.authentication = false;
                state.user_id = null;
                state.user_name = null;
                state.user_mail = null;
                if (typeof callback == 'function') {
                    callback(false);
                }
            }
        },
        LOGOUT: function (state) {
            state.authentication = false;
            state.user_id = null;
            state.user_name = null;
            state.user_mail = null;
        },
    },
    actions: {
        setLogin: function (context, callback) {
            context.commit('LOGIN', callback);
        },
        setLogout: function (context) {
            axios.post("/api/user/logout")
                .then(response => {
                    context.commit('LOGOUT');
                });
        }
    },
    getters: {
        isUserLogged(state) {
            return state.authentication;
        },
        getUserId(state) {
            return state.user_id;
        },
        getUserName(state) {
            return state.user_name;
        },
        getTeamActive(state) {
            return state.user_team;
        },
        getUserMail(state) {
            return state.user_mail;
        },
    },
    plugins: [createPersistedState()]

})

export default store;
