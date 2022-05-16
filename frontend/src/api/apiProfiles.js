import apiService from "@/api/apiService";

const getProfilePath = '/api/profiles';
const createProfilePath = '/api/profile/create';
const setSettingsPath = '/api/profile/{profileId}/settings';

export default {
    getProfiles() {
        return apiService.api.get(getProfilePath);
    },

    createProfile(projectId, name) {
        return apiService.api.post(createProfilePath, { project_id: Number.parseInt(projectId), name: name });
    },

    setSettings(profileId, settings) {
        return apiService.api.post(setSettingsPath.replace('{profileId}', profileId), { settings: settings });
    }
}
