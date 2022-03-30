import apiClients from "@/api/apiClients";
import apiProfiles from "@/api/apiProfiles";
//import { result } from "lodash";

function buildProfiles(items, clientId) {
    let result = [];

    items.forEach((el) => {
        result.push({
            id: el.id,
            label: el.name,
            icon: "pi pi-fw pi-tag",
            to: { name: "Profile", params: { id: el.id } },
        });
    });

    result.push({
        label: 'Добавить профиль',
        icon: "pi pi-fw pi-plus",
        to: { name: "CreateProfile", params: { clientId: clientId } },
    });

    return result;
}

function buildClients(items) {
    let result = [];

    items.forEach((el) => {
        result.push({
            id: el.id,
            label: el.name,
            icon: "pi pi-fw pi-tags",
            items: buildProfiles(el.profiles, el.id)
        });
    });

    result.push({
        label: 'Добавить клиента',
        icon: "pi pi-fw pi-plus",
        to: { name: "CreateClient" },
    });

    return result;
}

export default {
    state: () => ({
        clients: [],
    }),
    mutations: {
        setClients(state, clients) {
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
                    name: 'CreateProfile',
                    params: {
                        clientId: client.id
                    }
                });
            }).catch(() => {
                context.dispatch('error', 'Не удалось создать клиента');
            });
        },

        loadClients(context) {
            apiClients.getClients().then((result) => {
                context.commit('setClients', result.data.data);
            }).catch(() => {
                context.dispatch('error', 'Не удалось загрузить список клиентов');
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
        getClientsForMenu(state) {
            return [{
                label: "Клиенты",
                items: buildClients(state.clients)
            }];
        },

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
    }
}