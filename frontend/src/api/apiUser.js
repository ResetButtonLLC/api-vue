import apiService from "@/api/apiService";

const getUserInfoPath = '/api/user';
const getNotificationListPath = '/api/user/notifications';

export default {
    getInfo() {
        return apiService.api.get(getUserInfoPath);
    },

    getNotificationList() {
        return apiService.api.get(getNotificationListPath);
    },
}