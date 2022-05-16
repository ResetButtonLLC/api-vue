import apiService from "@/api/apiService";

const getProjectsPath = '/api/projects';
const createProjectPath = '/api/project';

export default {
    getProjects() {
        return apiService.api.get(getProjectsPath);
    },

    createProject(name) {
        return apiService.api.post(createProjectPath, { name: name });
    }
}
