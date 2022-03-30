import apiService from "@/api/apiService";

const getProfilePath = '/api/profiles';
const createProfilePath = '/api/profile/create';

export default {
    getProfiles() {
        return apiService.api.get(getProfilePath);
    },

    createProfile(clientId, name) {
        return apiService.api.post(createProfilePath, { clientId: clientId, name: name });
    }
}