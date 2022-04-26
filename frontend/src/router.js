import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/guest',
        name: 'Guest',
        component: () => import('@/views/GuestPage.vue'),
    },
    {
        path: '/',
        name: 'ClientList',
        component: () => import('@/views/pages/ClientList.vue'),
    },

    {
        path: '/test',
        name: 'test',
        props: true,
        component: () => import('@/views/Test.vue'),
    },

    {
        path: '/client/:id',
        name: 'ClientProfileList',
        props: true,
        component: () => import('@/views/pages/ClientProfileList.vue'),
    },

    {
        path: '/client/:clientId/profile/:id',
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
