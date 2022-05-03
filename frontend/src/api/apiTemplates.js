import apiService from "@/api/apiService";

const getTemplatesGlobalPath = '/api/templates/{profileId}/global';
const setTemplatesGlobalPath = '/api/templates/{profileId}/global/set';
const getTemplatesCategoriesPath = '/api/templates/{profileId}/categories';
const setTemplatesCategoriesPath = '/api/templates/{profileId}/categories/set';

export default {
    getTemplatesGlobal(profileId) {
        return apiService.api.get(getTemplatesGlobalPath.replace('{profileId}', profileId));
    },

    setTemplatesGlobal(profileId, templates) {
        return apiService.api.post(setTemplatesGlobalPath.replace('{profileId}', profileId), { templates: templates });
    },

    getTemplatesCategories(profileId) {
        return apiService.api.get(getTemplatesCategoriesPath.replace('{profileId}', profileId));
    },

    setTemplatesCategories(profileId, templates) {
        return apiService.api.post(setTemplatesCategoriesPath.replace('{profileId}', profileId), { templates: templates });
    }
}