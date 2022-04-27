import apiService from "@/api/apiService";

const getCampaignsImportedPath = '/api/categories/{profileId}';

export default {
    getCategories(profileId) {
        return apiService.api.get(getCampaignsImportedPath.replace('{profileId}', profileId));
    },
}