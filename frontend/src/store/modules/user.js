import apiUser from "@/api/apiUser";

export default {
    state: () => ({
        notifications: [],
        userInfo: {},
        inLoginProcess: false,
    }),
    mutations: {
        setNotifications(state, notifications) {
            state.notifications = notifications;
        },

        setUserInfo(state, info) {
            state.userInfo = info;
        },

        deleteNotification(state, id) {
            state.notifications = state.notifications.filter(el => el.id !== id);
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
            context.commit('plusLoading');

            apiUser.getInfo().then((result) => {
                context.commit('setUserInfo', result.data.data);
                context.commit('minusLoading');
                context.commit('endLogin');
            }).catch(() => { context.commit('minusLoading'); });
        },

        updateNotificationList(context) {
            context.commit('plusLoading');

            apiUser.getNotificationList().then((result) => {
                context.commit('setNotifications', result.data.data);
                context.commit('minusLoading');
            }).catch(() => { context.commit('minusLoading'); });
        },

        deleteNotification(context, id) {
            context.commit('deleteNotification', id);
        },

        logout(context) {
            context.commit('setUserInfo', {});
            context.commit('setProjectList', []);
            context.commit('setNotifications', []);
            context.commit('startLogin');
        },
    },

    getters: {
        getNotificationCount(state) {
            return state.notifications.length;
        },

        getNotifications(state) {
            return state.notifications;
        },

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