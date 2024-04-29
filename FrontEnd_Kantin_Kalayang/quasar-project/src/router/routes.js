const routes = [{
        path: '/',
        component: () =>
            import ('layouts/MainLayout.vue'),
        children: [{
            path: '',
            component: () =>
                import ('pages/IndexPage.vue')
        }, {
            path: 'register',
            component: () =>
                import ('pages/RegisterPage.vue')
        }, {
            path: 'login',
            component: () =>
                import ('pages/LoginPage.vue')
        }, {
            path: 'admin',
            component: () =>
                import ('pages/AdminPage.vue')
        }]
    },

    // Always leave this as last one,
    // but you can also remove it
    {
        path: '/:catchAll(.*)*',
        component: () =>
            import ('pages/ErrorNotFound.vue')
    }
]

export default routes