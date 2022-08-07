import apiService from "@/api/apiService";

const getCategoriesPath = '/api/categories/{profileId}/get';
const setCategoriesPath = '/api/categories/{profileId}/set';

export default {
    getCategories(profileId) {
        return apiService.api.get(getCategoriesPath.replace('{profileId}', profileId));
    },

    setCategories(profileId, categories) {
        return apiService.api.post(setCategoriesPath.replace('{profileId}', profileId), { categories: categories });
    }
}