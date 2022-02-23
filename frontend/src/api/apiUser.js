import apiService from "@/api/apiService";

const getUserInfoPath = '/api/user';

export default {
    getInfo() {
        return apiService.api.get(getUserInfoPath);
    },
}