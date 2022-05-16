import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/guest',
        name: 'Guest',
        component: () => import('@/views/GuestPage.vue'),
    },
    {
        path: '/',
        name: 'ProjectList',
        component: () => import('@/views/pages/ProjectList.vue'),
    },

    {
        path: '/test',
        name: 'test',
        props: true,
        component: () => import('@/views/Test.vue'),
    },

    {
        path: '/project/:id',
        name: 'ProjectProfileList',
        props: true,
        component: () => import('@/views/pages/ProjectProfileList.vue'),
    },

    {
        path: '/project/:projectId/profile/:id',
        name: 'Profile',
        props: true,
        component: () => import('@/views/pages/Profile.vue'),
    },

    {
        path: "/:pathMatch(.*)*",
        name: 'ErrorPage',
        props: true,
        component: () => import('@/views/ErrorPage.vue')
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }
        if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth',
            }
        } else {
            return { left: 0, top: 0 };
        }
    },
});

export default router;
