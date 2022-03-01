import apiClients from "@/api/apiClients";

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
        to: { name: "CreateProfile", params: { clientId: clientId, isCreate: true } },
    });

    return result;
}

function buildClients(items) {
    if (!items.length) {
        return [];
    }

    return items.map((el) => {
        return {
            id: el.id,
            label: el.name,
            icon: "pi pi-fw pi-tags",
            items: buildProfiles(el.profiles, el.id)
        }
    });
}

export default {
    state: () => ({
        clients: [],
    }),
    mutations: {
        setClients(state, clients) {
            state.clients = clients;
        },
    },
    actions: {
        loadClients(context) {
            apiClients.getClients().then((result) => {
                context.commit('setClients', result.data.data);
            }).catch(() => {
                context.commit('error', 'Не удалось загрузить список клиентов');
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
    }
}