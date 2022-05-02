import apiService from "@/api/apiService";

const getPreviewGroupsPath = '/api/preview/{profileId}/groups';
const getPreviewAdsPath = '/api/preview/{profileId}/ads';
const getPreviewKeywordsPath = '/api/preview/{profileId}/keywords';

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