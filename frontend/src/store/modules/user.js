import apiUser from "@/api/apiUser";

export default {
    state: () => ({
        userInfo: {},
        inLoginProcess: false,
    }),
    mutations: {
        setUserInfo(state, info) {
            state.userInfo = info;
        },

        startLogin(state) {
            state.inLoginProcess = true;
        },

        endLogin(state) {
            state.inLoginProcess = false;
        }
    },
    actions: {
        updateUserInfo(context) {
            apiUser.getInfo().then((result) => {
                context.commit('setUserInfo', result.data.data);
                context.commit('endLogin');
            });
        },

        logout(context) {
            context.commit('setUserInfo', {});
            context.commit('startLogin');
        },
    },

    getters: {
        isAuthorized(state) {
            return (state.userInfo.id > 0);
        },

        getUserAvatar(state) {
            return state.userInfo.avatar;
        },

        getUserId(state) {
            return state.userInfo.id;
        },

        getUserName(state) {
            return state.userInfo.name;
        },

        isLoginProcess(state) {
            return state.inLoginProcess;
        }
    }
}