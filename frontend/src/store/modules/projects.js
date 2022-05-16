import apiProjects from "@/api/apiProjects";
import apiProfiles from "@/api/apiProfiles";
//import { result } from "lodash";

function buildProfiles(items, projectId) {
    let result = [];

    items.forEach((el) => {
        result.push({
            id: el.id,
            label: el.name,
            icon: "pi pi-fw pi-tag",
            to: { name: "Profile", params: { id: el.id } },
        });
    });

    result.push({
        label: 'Добавить профиль',
        icon: "pi pi-fw pi-plus",
        to: { name: "CreateProfile", params: { projectId: projectId } },
    });

    return result;
}

function buildProjects(items) {
    let result = [];

    items.forEach((el) => {
        result.push({
            id: el.id,
            label: el.name,
            icon: "pi pi-fw pi-tags",
            items: buildProfiles(el.profiles, el.id)
        });
    });

    result.push({
        label: 'Добавить проект',
        icon: "pi pi-fw pi-plus",
        to: { name: "CreateProject" },
    });

    return result;
}

export default {
    state: () => ({
        projects: [],
    }),
    mutations: {
        setProjects(state, projects) {
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
                    name: 'CreateProfile',
                    params: {
                        projectId: project.id
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

        createProfile(context, { projectId, name }) {
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
        getProjectsForMenu(state) {
            return [{
                label: "Проекты",
                items: buildProjects(state.projects)
            }];
        },

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
    }
}
