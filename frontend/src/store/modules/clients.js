import apiClients from "@/api/apiClients";
import apiProfiles from "@/api/apiProfiles";

export default {
    state: () => ({
        clients: [],
        isClientLoaded: false,
    }),
    mutations: {
        setClients(state, clients) {
            state.isClientLoaded = true;
            state.clients = clients;
        },

        addClient(state, client) {
            state.clients.push(client);
        },

        addProfile(state, profile) {
            let client = state.clients.find((el) => el.id == profile.client_id);

            client.profiles.push(profile);
        }
    },
    actions: {
        createClient(context, name) {
            apiClients.createClient(name).then((result) => {
                let client = result.data.data;
                context.commit('addClient', client);

                context.dispatch('route', {
                    name: 'ClientProfileList',
                    params: {
                        id: client.id
                    }
                });
            }).catch(() => {
                context.dispatch('error', 'Не удалось создать проект');
            });
        },

        loadClients(context) {
            apiClients.getClients().then((result) => {
                context.commit('setClients', result.data.data);
            }).catch(() => {
                context.dispatch('error', 'Не удалось загрузить список проектов');
            });
        },

        createProfile(context, { clientId, name }) {
            apiProfiles.createProfile(clientId, name).then((result) => {
                let profile = result.data.data;

                context.commit('addProfile', profile);

                context.dispatch('route', {
                    name: 'Profile',
                    params: {
                        id: profile.id,
                        clientId: clientId
                    }
                });


            }).catch(() => {
                context.dispatch('error', 'Не удалось создать профиль');
            });
        },
    },

    getters: {
        getClients(state) {
            return state.clients;
        },

        getProfiles(state) {
            let result = [];

            state.clients.forEach((el) => {
                result = result.concat(el.profiles);
            });

            return result;
        },

        isClientLoaded(state) {
            return state.isClientLoaded;
        }
    }
}