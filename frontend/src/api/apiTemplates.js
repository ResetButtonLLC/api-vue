import apiService from "@/api/apiService";

const getTemplatesPath = '/api/templates/{profileId}/get';
const setTemplatesPath = '/api/templates/{profileId}/set';

export default {
    getTemplates(profileId) {
        return apiService.api.get(getTemplatesPath.replace('{profileId}', profileId));
    },

    setTemplates(profileId, templates) {
        return apiService.api.post(setTemplatesPath.replace('{profileId}', profileId), { templates: templates });
    }
}