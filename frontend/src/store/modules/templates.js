import apiTemplates from "@/api/apiTemplates";

const TYPE_GLOBAL = 1;
const TYPE_CATEGORIES = 2;

export default {
    state: () => ({
        templates: [],
        templatesGlobal: [],
        templatesCategories: [],
    }),
    mutations: {
        setProfileTemplates(state, { profileId, type, templates }) {
            let templateBase = type == TYPE_GLOBAL ? state.templatesGlobal : state.templatesCategories;
            let result = templateBase.find((el) => el.profileId == profileId);

            if (result === undefined) {
                templateBase.push({ profileId: profileId, templates: [...templates], isLoading: false });
            } else {
                result.templates = [...templates];
            }
        },

        setLoading(state, { profileId, type, isLoading }) {
            let templates = type == TYPE_GLOBAL ? state.templatesGlobal : state.templatesCategories;
            let result = templates.find((el) => el.profileId == profileId);

            if (result === undefined) {
                templates.push({ profileId: profileId, templates: [], isLoading: isLoading });
            } else {
                result.isLoading = isLoading;
            }
        },

        addTemplate(state, { profileId, type, template }) {
            let templates = type == TYPE_GLOBAL ? state.templatesGlobal : state.templatesCategories;
            let result = templates.find((el) => el.profileId == profileId);

            if (result !== undefined) {
                result.templates.push(template);
            }
        },

        deleteTemplate(state, { profileId, type, index }) {
            let templates = type == TYPE_GLOBAL ? state.templatesGlobal : state.templatesCategories;
            let result = templates.find((el) => el.profileId == profileId);

            if (result !== undefined) {
                result.templates.splice(index, 1);
            }
        }
    },
    actions: {
        getProfileTemplatesGlobal(context, profileId) {
            context.commit('setLoading', { profileId: profileId, type: TYPE_GLOBAL, isLoading: true });

            apiTemplates.getTemplatesGlobal(profileId).then((result) => {
                context.commit('setProfileTemplates', { profileId: profileId, type: TYPE_GLOBAL, templates: result.data.data });
            }).catch(() => {
                context.commit('setProfileTemplates', { profileId: profileId, type: TYPE_GLOBAL, templates: [] });
            }).finally(() => {
                context.commit('setLoading', { profileId: profileId, type: TYPE_GLOBAL, isLoading: false });
            })
        },

        getProfileTemplatesCategories(context, profileId) {
            context.commit('setLoading', { profileId: profileId, type: TYPE_CATEGORIES, isLoading: true });

            apiTemplates.getTemplatesCategories(profileId).then((result) => {
                context.commit('setProfileTemplates', { profileId: profileId, type: TYPE_CATEGORIES, templates: result.data.data });
            }).catch(() => {
                context.commit('setProfileTemplates', { profileId: profileId, type: TYPE_CATEGORIES, templates: [] });
            }).finally(() => {
                context.commit('setLoading', { profileId: profileId, type: TYPE_CATEGORIES, isLoading: false });
            })
        },

        addEmptyTemplateGlobal(context, profileId) {
            context.commit('addTemplate', { profileId: profileId, type: TYPE_GLOBAL, template: {} });
        },

        addTemplateGlobal(context, { profileId, template }) {
            context.commit('addTemplate', { profileId: profileId, type: TYPE_GLOBAL, template: template });
        },

        deleteTemplateGlobal(context, { profileId, index }) {
            context.commit('deleteTemplate', { profileId: profileId, type: TYPE_GLOBAL, index: index });
        },

        addEmptyTemplateCategories(context, profileId) {
            context.commit('addTemplate', { profileId: profileId, type: TYPE_CATEGORIES, template: {} });
        },

        addTemplateCategories(context, { profileId, template }) {
            context.commit('addTemplate', { profileId: profileId, type: TYPE_CATEGORIES, template: template });
        },

        deleteTemplateCategories(context, { profileId, index }) {
            context.commit('deleteTemplate', { profileId: profileId, type: TYPE_CATEGORIES, index: index });
        }
    },

    getters: {
        isTemplatesGlobalLoadings: (state) => (profileId) => {
            let result = state.templatesGlobal.find((el) => el.profileId == profileId);

            return result === undefined ? true : result.isLoading;
        },

        isTemplatesCategoriesLoadings: (state) => (profileId) => {
            let result = state.templatesCategories.find((el) => el.profileId == profileId);

            return result === undefined ? true : result.isLoading;
        },

        getProfileTemplatesGlobal: (state) => (profileId) => {
            let result = state.templatesGlobal.find((el) => el.profileId == profileId);

            return result === undefined ? [] : result.templates;
        },

        getProfileTemplatesCategories: (state) => (profileId) => {
            let result = state.templatesCategories.find((el) => el.profileId == profileId);

            return result === undefined ? [] : result.templates;
        },

        getTemplateGlobalCount: (state) => (profileId) => {
            let result = state.templatesGlobal.find((el) => el.profileId == profileId);

            return result.templates.length ?? 0;
        },

        getTemplateCategoriesCount: (state) => (profileId) => {
            let result = state.templatesCategories.find((el) => el.profileId == profileId);

            return result.templates.length ?? 0;
        }
    }
}