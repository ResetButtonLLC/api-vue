import apiService from "@/api/apiService";

const getClientsPath = '/api/clients';
const createClientPath = '/api/client/create';

export default {
    getClients() {
        return apiService.api.get(getClientsPath);
    },

    createClient(name) {
        return apiService.api.post(createClientPath, { name: name });
    }
}