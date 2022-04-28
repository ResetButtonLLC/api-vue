import apiService from "@/api/apiService";

const getPreviewGroupsPath = '/api/preview/groups/{profileId}';
const getPreviewAdsPath = '/api/preview/ads/{profileId}';
const getPreviewKeywordsPath = '/api/preview/keywords/{profileId}';

export default {
    getPreviewGroups(profileId, filters, page) {
        return apiService.api.post(getPreviewGroupsPath.replace('{profileId}', profileId), { filters: filters, page: page });
    },

    getPreviewAds(profileId, filters, page) {
        return apiService.api.post(getPreviewAdsPath.replace('{profileId}', profileId), { filters: filters, page: page });
    },

    getPreviewKeywords(profileId, filters, page) {
        return apiService.api.post(getPreviewKeywordsPath.replace('{profileId}', profileId), { filters: filters, page: page });
    },
}