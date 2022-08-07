import apiService from "@/api/apiService";

const getPreviewGroupsPath = '/api/preview/{profileId}/groups';
const getPreviewAdsPath = '/api/preview/{profileId}/ads';
const getPreviewKeywordsPath = '/api/preview/{profileId}/keywords';

export const PREVIEW_GROUP = 1;
export const PREVIEW_AD = 2;
export const PREVIEW_KEYWORD = 3;

function getPathFromType(type) {
    switch (type) {
        case PREVIEW_GROUP:
            return getPreviewGroupsPath;

        case PREVIEW_AD:
            return getPreviewAdsPath;

        case PREVIEW_KEYWORD:
            return getPreviewKeywordsPath;

        default:
            return '';
    }
}

export default {
    getPreview(type, profileId, filters, page) {
        return apiService.api.post(getPathFromType(type).replace('{profileId}', profileId), { filters: filters, page: page });
    }
}