const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout'),
    children: [
      { path: '', name: 'index', component: () => import('pages/Index') },
      { path: 'about', name: 'about', component: () => import('pages/About') },
      { path: 'register', name: 'register', component: () => import('pages/auth/Register') }
    ]
  },
  {
    path: '/auth',
    component: () => import('layouts/AuthLayout'),
    children: [
      { path: 'login', name: 'login', meta: { auth: false }, component: () => import('pages/auth/Login') },
      { path: 'password', name: 'password', component: { render: h => h('router-view') },
        children: [
          { path: 'forgot', name: 'password.forgot', component: () => import('pages/auth/Login') },
          { path: 'reset', name: 'password.reset', component: () => import('pages/auth/Login') }
        ]
      },
    ]
  },
  {
    path: '/dashboard',
    component: () => import('layouts/DashboardLayout'),
    children: [
      { path: '', name: 'dashboard.index', meta: { auth: true }, component: () => import('pages/dashboard/Index') }
    ]
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404')
  })
}

export default routes
