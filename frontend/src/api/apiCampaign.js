import apiService from "@/api/apiService";

const getCampaignsImportedPath = '/api/campaigns/{profileId}/imported';
const getCampaignsAllPath = '/api/campaigns/{profileId}/all';
const setCampaignsPath = '/api/campaigns/{profileId}/set';

export default {
    getCampaignsImported(profileId) {
        return apiService.api.get(getCampaignsImportedPath.replace('{profileId}', profileId));
    },

    getCampaignsAll(profileId) {
        return apiService.api.get(getCampaignsAllPath.replace('{profileId}', profileId));
    },

    setCampaigns(profileId, campaigns) {
        return apiService.api.post(setCampaignsPath.replace('{profileId}', profileId), { campaigns: campaigns });
    }
}