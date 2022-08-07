import apiCampaign from "@/api/apiCampaign";

export default {
    state: () => ({
        campaigns: []
    }),
    mutations: {
        setProfileCampaigns(state, { type, profileId, campaigns }) {
            let result = state.campaigns.find((el) => el.profileId == profileId && el.type == type);

            if (result === undefined) {
                state.campaigns.push({ type: type, profileId: profileId, campaigns: [...campaigns], isLoading: false });
            } else {
                result.campaigns = [...campaigns];
            }
        },

        setLoading(state, { type, profileId, isLoading }) {
            let result = state.campaigns.find((el) => el.profileId == profileId && el.type == type);

            if (result === undefined) {
                state.campaigns.push({ type: type, profileId: profileId, campaigns: [], isLoading: isLoading });
            } else {
                result.isLoading = isLoading;
            }
        },
    },
    actions: {
        getProfileCampaigns(context, { type, profileId }) {
            /*
            if (context.state.campaigns.find((el) => el.profileId == profileId)) {
                return;
            }
            */

            context.commit('setLoading', { type: type, profileId: profileId, isLoading: true });

            let request = type == 'imported' ? apiCampaign.getCampaignsImported(profileId) : apiCampaign.getCampaignsAll(profileId);

            request.then((result) => {
                context.commit('setProfileCampaigns', { type: type, profileId: profileId, campaigns: result.data.data });
            }).catch(() => {
                context.commit('setProfileCampaigns', { type: type, profileId: profileId, campaigns: [] });
            }).finally(() => {
                context.commit('setLoading', { type: type, profileId: profileId, isLoading: false });
            })
        },
    },

    getters: {
        isCampaignsLoadings: (state) => (profileId, type) => {
            let result = state.campaigns.find((el) => el.profileId == profileId && el.type == type);

            return result === undefined ? true : result.isLoading;
        },

        getProfileCampaigns: (state) => (profileId, type) => {
            let result = state.campaigns.find((el) => el.profileId == profileId && el.type == type);

            return result === undefined ? [] : result.campaigns;
        }
    }
}