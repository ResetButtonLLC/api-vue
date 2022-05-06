//import apiProfiles from "@/api/apiProfiles";

export default {
    /*
        state: () => ({
            profiles: [],
        }),
        mutations: {
            setProfiles(state, profiles) {
                state.profiles = profiles;
            },

            addProfile(state, profile) {
                state.profiles.push(profile);
            }
        },
        actions: {
            createProfile(context, { projectId, name }) {
                apiProfiles.createProfile(projectId, name).then((result) => {
                    let profile = result.data.data;
                    context.commit('addProfile', profile);

                    context.dispatch('route', {
                        name: 'Profile',
                        params: {
                            id: profile.id,
                            projectId: projectId
                        }
                    });
                }).catch(() => {
                    context.dispatch('error', 'Не удалось создать профиль');
                });
            },

            loadProfiles(context) {
                apiProfiles.getProfiles().then((result) => {
                    context.commit('setProfiles', result.data.data);
                }).catch(() => {
                    context.dispatch('error', 'Не удалось загрузить список профилей');
                });
            },
        },

        getters: {
            getProfiles(state) {
                return state.profiles;
            },
        }
        */
}
