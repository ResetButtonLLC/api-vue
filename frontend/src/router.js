import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/test',
        name: 'test',
        props: true,
        component: () => import('@/views/Test.vue'),
    },
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
        path: '/project/:id',
        name: 'ProjectProfileList',
        props: true,
        component: () => import('@/views/pages/ProjectProfileList.vue'),
    },

    {
        path: '/profile/:profileId',
        name: 'Profile',
        props: true,
        component: () => import('@/views/pages/Profile/Info.vue'),
    },

    {
        path: '/profile/:profileId/main',
        name: 'ProfileSettingsMain',
        props: true,
        component: () => import('@/views/pages/Profile/SettingsMain.vue'),
    },

    {
        path: '/profile/:profileId/import',
        name: 'ProfileImportAndFilters',
        props: true,
        component: () => import('@/views/pages/Profile/ImportAndFilters.vue'),
    },

    {
        path: '/profile/:profileId/categories',
        name: 'ProfileCategories',
        props: true,
        component: () => import('@/views/pages/Profile/Categories.vue'),
    },

    {
        path: '/profile/:profileId/ads',
        name: 'ProfileGenerateAds',
        props: true,
        component: () => import('@/views/pages/Profile/GenerateAds.vue'),
    },

    {
        path: '/profile/:profileId/keywords',
        name: 'ProfileGenerateKeywords',
        props: true,
        component: () => import('@/views/pages/Profile/GenerateKeywords.vue'),
    },

    {
        path: '/profile/:profileId/autoupdate',
        name: 'ProfileAutoupdateSettings',
        props: true,
        component: () => import('@/views/pages/Profile/AutoupdateSettings.vue'),
    },

    {
        path: '/profile/:profileId/preview',
        name: 'ProfilePreview',
        props: true,
        component: () => import('@/views/pages/Profile/Preview.vue'),
    },

    {
        path: '/profile/:profileId/statistic',
        name: 'ProfileStatistic',
        props: true,
        component: () => import('@/views/pages/Profile/Statistic.vue'),
    },

    {
        path: '/profile/:profileId/updates',
        name: 'ProfileAutoupdateLogs',
        props: true,
        component: () => import('@/views/pages/Profile/AutoupdateLogs.vue'),
    },

    {
        path: '/profile/:profileId/logs',
        name: 'ProfileLogs',
        props: true,
        component: () => import('@/views/pages/Profile/Logs.vue'),
    },

    {
        path: '/admin',
        name: 'AdminPanel',
        component: () => import('@/views/pages/AdminPanel/Info.vue'),
    },

    {
        path: '/admin/users',
        name: 'AdminPanelUsers',
        component: () => import('@/views/pages/AdminPanel/Users.vue'),
    },

    {
        path: '/admin/replacements/ad',
        name: 'AdminPanelAdReplacements',
        component: () => import('@/views/pages/AdminPanel/AdReplacements.vue'),
    },

    {
        path: '/admin/replacements/keyword',
        name: 'AdminPanelKeywordReplacements',
        component: () => import('@/views/pages/AdminPanel/KeywordReplacements.vue'),
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
    }
});

export default router;
