import apiProjects from "@/api/apiProjects";
import apiProfiles from "@/api/apiProfiles";
//NEW
//import { result } from "lodash";

export default {
    state: () => ({
        projects: [],
        isProjectLoading: false,
    }),
    mutations: {
        setProjects(state, projects) {
            state.projects = projects;
        },

        setProjectLoading(state, isLoading) {
            state.isProjectLoading = isLoading;
        },

        addProject(state, project) {
            state.projects.push(project);
        },

        addProfile(state, profile) {
            let project = state.projects.find((el) => el.id == profile.project_id);

            project.profiles.push(profile);
        }
    },
    actions: {
        createProject(context, name) {
            apiProjects.createProject(name).then((result) => {
                let project = result.data.data;
                context.commit('addProject', project);

                context.dispatch('route', {
                    name: 'ProjectProfileList',
                    params: {
                        id: project.id
                    }
                });
            }).catch(() => {
                context.dispatch('error', 'Не удалось создать проект');
            });
        },

        loadProjects(context) {
            context.commit('setProjectLoading', true);

            apiProjects.getProjects().then((result) => {
                context.commit('setProjects', result.data.data);
            }).catch(() => {
                context.dispatch('error', 'Не удалось загрузить список проектов');
            }).finally(() => {
                context.commit('setProjectLoading', false);
            });
        },

        createProfile(context, { projectId, name }) {
            apiProfiles.createProfile(projectId, name).then((result) => {
                let profile = result.data.data;

                context.commit('addProfile', profile);

                context.dispatch('route', {
                    name: 'Profile',
                    params: {
                        profileId: profile.id
                    }
                });
            }).catch(() => {
                context.dispatch('error', 'Не удалось создать профиль');
            });
        },
    },

    getters: {
        getProjects(state) {
            return state.projects;
        },

        getProjectFromProfileId: (state) => (id) => {
            let result = null;
            state.projects.forEach((project) => {
                if (project.profiles.find((profile) => profile.id == id)) {
                    result = project;
                }
            });

            return result;
        },

        getProfileFromId: (state) => (id) => {
            let result = null;
            state.projects.forEach((project) => {
                project.profiles.forEach((profile) => {
                    if (profile.id == id) {
                        result = profile;
                    }
                });
            });

            return result;
        },

        getProfiles(state) {
            let result = [];

            state.projects.forEach((el) => {
                result = result.concat(el.profiles);
            });

            return result;
        },

        isProjectLoading(state) {
            return state.isProjectLoading;
        }
    }
}
