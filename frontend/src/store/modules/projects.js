import apiProjects from "@/api/apiProjects";
import apiProfiles from "@/api/apiProfiles";

export default {
    state: () => ({
        projects: [],
        isProjectLoaded: false,
    }),
    mutations: {
        setProjects(state, projects) {
            state.isProjectLoaded = true;
            state.projects = projects;
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
            apiProjects.getProjects().then((result) => {
                context.commit('setProjects', result.data.data);
            }).catch(() => {
                context.dispatch('error', 'Не удалось загрузить список проектов');
            });
        },

        createProfile(context, { projectId: projectId, name }) {
            apiProfiles.createProfile(projectId, name).then((result) => {
                let profile = result.data.data;

                context.commit('addProfile', profile);

                context.dispatch('route', {
                    name: 'Profile',
                    params: {
                        id: profile.id,
                        projectId: projectId
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

        getProfiles(state) {
            let result = [];

            state.projects.forEach((el) => {
                result = result.concat(el.profiles);
            });

            return result;
        },

        isProjectLoaded(state) {
            return state.isProjectLoaded;
        }
    }
}
