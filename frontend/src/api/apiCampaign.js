import apiService from "@/api/apiService";

const getCampaignsImportedPath = '/api/campaigns/{profileId}/imported';
const getCampaignsAllPath = '/api/campaigns/{profileId}/all';

export default {
    getCampaignsImported(profileId) {
        return apiService.api.get(getCampaignsImportedPath.replace('{profileId}', profileId));
    },

    getCampaignsAll(profileId) {
        return apiService.api.get(getCampaignsAllPath.replace('{profileId}', profileId));
    },
}