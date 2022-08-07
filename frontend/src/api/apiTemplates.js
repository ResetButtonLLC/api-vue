import apiService from "@/api/apiService";

const getTemplatesGlobalPath = '/api/templates/{profileId}/global';
const setTemplatesGlobalPath = '/api/templates/{profileId}/global/set';
const getTemplatesSmartPath = '/api/templates/{profileId}/smart';
const setTemplatesSmartPath = '/api/templates/{profileId}/smart/set';

export default {
    getTemplatesGlobal(profileId) {
        return apiService.api.get(getTemplatesGlobalPath.replace('{profileId}', profileId));
    },

    setTemplatesGlobal(profileId, templates) {
        return apiService.api.post(setTemplatesGlobalPath.replace('{profileId}', profileId), { templates: templates });
    },

    getTemplatesCategories(profileId) {
        return apiService.api.get(getTemplatesSmartPath.replace('{profileId}', profileId));
    },

    setTemplatesCategories(profileId, templates) {
        return apiService.api.post(setTemplatesSmartPath.replace('{profileId}', profileId), { templates: templates });
    }
}