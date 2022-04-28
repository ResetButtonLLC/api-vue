import apiTemplates from "@/api/apiTemplates";

export default {
    state: () => ({
        templates: []
    }),
    mutations: {
        setProfileTemplates(state, { profileId, templates }) {
            let result = state.templates.find((el) => el.profileId == profileId);

            if (result === undefined) {
                state.templates.push({ profileId: profileId, templates: [...templates], isLoading: false });
            } else {
                result.templates = [...templates];
            }
        },

        setLoading(state, { profileId, isLoading }) {
            let result = state.templates.find((el) => el.profileId == profileId);

            if (result === undefined) {
                state.templates.push({ profileId: profileId, templates: [], isLoading: isLoading });
            } else {
                result.isLoading = isLoading;
            }
        },

        addEmptyTemplate(state, profileId) {
            let result = state.templates.find((el) => el.profileId == profileId);

            if (result !== undefined) {
                result.templates.push({});
            }
        },

        deleteTemplate(state, { profileId, index }) {
            let result = state.templates.find((el) => el.profileId == profileId);

            if (result !== undefined) {
                result.templates.splice(index, 1);
            }
        }
    },
    actions: {
        getProfileTemplates(context, profileId) {
            /*
            if (context.state.templates.find((el) => el.profileId == profileId)) {
                return;
            }
            */

            context.commit('setLoading', { profileId: profileId, isLoading: true });

            apiTemplates.getTemplates(profileId).then((result) => {
                context.commit('setProfileTemplates', { profileId: profileId, templates: result.data.data });
            }).catch(() => {
                context.commit('setProfileTemplates', { profileId: profileId, templates: [] });
            }).finally(() => {
                context.commit('setLoading', { profileId: profileId, isLoading: false });
            })
        },

        addEmptyTemplate(context, profileId) {
            context.commit('addEmptyTemplate', profileId);
        },

        deleteTemplate(context, { profileId, index }) {
            context.commit('deleteTemplate', { profileId: profileId, index: index });
        }
    },

    getters: {
        isTemplatesLoadings: (state) => (profileId) => {
            let result = state.templates.find((el) => el.profileId == profileId);

            return result === undefined ? true : result.isLoading;
        },

        getProfileTemplates: (state) => (profileId) => {
            let result = state.templates.find((el) => el.profileId == profileId);

            return result === undefined ? [] : result.templates;
        },

        getTemplateCount: (state) => (profileId) => {
            let result = state.templates.find((el) => el.profileId == profileId);

            return result.templates.length ?? 0;
        }
    }
}