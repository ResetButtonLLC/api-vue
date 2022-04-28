import apiService from "@/api/apiService";

const getTemplatesPath = '/api/templates/{profileId}';

export default {
    getTemplates(profileId) {
        return apiService.api.get(getTemplatesPath.replace('{profileId}', profileId));
    },
}