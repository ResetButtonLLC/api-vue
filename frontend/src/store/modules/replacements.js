import apiReplacement from "@/api/apiReplacement";

export default {
    state: () => ({
        replacements: []
    }),
    mutations: {
        setProfileReplacements(state, { profileId, replacements }) {
            let result = state.replacements.find((el) => el.profileId == profileId);

            if (result === undefined) {
                state.replacements.push({ profileId: profileId, replacements: [...replacements], isLoading: false });
            } else {
                result.replacements = [...replacements];
            }
        },

        setLoading(state, { profileId, isLoading }) {
            let result = state.replacements.find((el) => el.profileId == profileId);

            if (result === undefined) {
                state.replacements.push({ profileId: profileId, replacements: [], isLoading: isLoading });
            } else {
                result.isLoading = isLoading;
            }
        },

        addEmptyReplacement(state, profileId) {
            let result = state.replacements.find((el) => el.profileId == profileId);

            if (result !== undefined) {
                result.replacements.push({
                    from: "",
                    to: "",
                });
            }
        },

        deleteReplacement(state, { profileId, index }) {
            let result = state.replacements.find((el) => el.profileId == profileId);

            if (result !== undefined) {
                result.replacements.splice(index, 1);
            }
        }
    },
    actions: {
        getProfileReplacements(context, profileId) {
            /*
            if (context.state.replacements.find((el) => el.profileId == profileId)) {
                return;
            }
            */

            context.commit('setLoading', { profileId: profileId, isLoading: true });

            apiReplacement.getReplacement(profileId).then((result) => {
                context.commit('setProfileReplacements', { profileId: profileId, replacements: result.data.data });
            }).catch(() => {
                context.commit('setProfileReplacements', { profileId: profileId, replacements: [] });
            }).finally(() => {
                context.commit('setLoading', { profileId: profileId, isLoading: false });
            })
        },

        addEmptyReplacement(context, profileId) {
            context.commit('addEmptyReplacement', profileId);
        },

        deleteReplacement(context, { profileId, index }) {
            context.commit('deleteReplacement', { profileId: profileId, index: index });
        }
    },

    getters: {
        isReplacementsLoadings: (state) => (profileId) => {
            let result = state.replacements.find((el) => el.profileId == profileId);

            return result === undefined ? true : result.isLoading;
        },

        getProfileReplacements: (state) => (profileId) => {
            let result = state.replacements.find((el) => el.profileId == profileId);

            return result === undefined ? [] : result.replacements;
        },

        getReplacementCount: (state) => (profileId) => {
            let result = state.replacements.find((el) => el.profileId == profileId);

            return result.replacements.length ?? 0;
        }
    }
}