import apiService from "@/api/apiService";

const getClientsPath = '/api/clients';

export default {
    getClients() {
        return apiService.api.get(getClientsPath);
    },
}