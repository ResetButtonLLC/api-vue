import apiService from "@/api/apiService";

const getReplacementPath = '/api/replacements/{profileId}/get';
const setReplacementPath = '/api/replacements/{profileId}/set';

export default {
    getReplacement(profileId) {
        return apiService.api.get(getReplacementPath.replace('{profileId}', profileId));
    },

    setReplacement(profileId, replacements) {
        return apiService.api.post(setReplacementPath.replace('{profileId}', profileId), { replacements: replacements });
    }
}