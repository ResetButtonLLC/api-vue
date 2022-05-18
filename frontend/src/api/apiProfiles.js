import apiService from "@/api/apiService";

const getProfilePath = '/api/profile/';
const getProfilesPath = '/api/profiles';
const createProfilePath = '/api/profile';
const setSettingsPath = '/api/profile/{profileId}/settings';

export default {

    getProfile(profileId) {
        return apiService.api.get(getProfilePath.replace('{profileId}', profileId));
    },

    getProfiles() {
        return apiService.api.get(getProfilesPath);
    },

    createProfile(projectId, name) {
        return apiService.api.post(createProfilePath, { project_id: Number.parseInt(projectId), name: name });
    },

    setSettings(profileId, settings) {
        return apiService.api.post(setSettingsPath.replace('{profileId}', profileId), { settings: settings });
    }
}
