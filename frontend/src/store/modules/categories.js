import apiCategory from "@/api/apiCategory";

export default {
    state: () => ({
        categories: []
    }),
    mutations: {
        setProfileCategories(state, { profileId, categories }) {
            let result = state.categories.find((el) => el.profileId == profileId);

            if (result === undefined) {
                state.categories.push({ profileId: profileId, categories: [...categories], isLoading: false });
            } else {
                result.categories = [...categories];
            }
        },

        setLoading(state, { profileId, isLoading }) {
            let result = state.categories.find((el) => el.profileId == profileId);

            if (result === undefined) {
                state.categories.push({ profileId: profileId, categories: [], isLoading: isLoading });
            } else {
                result.isLoading = isLoading;
            }
        },
    },
    actions: {
        getProfileCategories(context, profileId) {
            /*
            if (context.state.categories.find((el) => el.profileId == profileId)) {
                return;
            }
            */

            context.commit('setLoading', { profileId: profileId, isLoading: true });

            apiCategory.getCategories(profileId).then((result) => {
                context.commit('setProfileCategories', { profileId: profileId, categories: result.data.data });
            }).catch(() => {
                context.commit('setProfileCategories', { profileId: profileId, categories: [] });
            }).finally(() => {
                context.commit('setLoading', { profileId: profileId, isLoading: false });
            })
        },
    },

    getters: {
        isCategoryLoadings: (state) => (profileId) => {
            let result = state.categories.find((el) => el.profileId == profileId);

            return result === undefined ? true : result.isLoading;
        },

        getProfileCategories: (state) => (profileId) => {
            let result = state.categories.find((el) => el.profileId == profileId);

            return result === undefined ? [] : result.categories;
        }
    }
}