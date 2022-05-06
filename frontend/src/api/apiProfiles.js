import apiService from "@/api/apiService";

const getProfilePath = '/api/profiles';
const createProfilePath = '/api/profile/create';

export default {
    getProfiles() {
        return apiService.api.get(getProfilePath);
    },

    createProfile(projectId, name) {
        return apiService.api.post(createProfilePath, { projectId: projectId, name: name });
    }
}
