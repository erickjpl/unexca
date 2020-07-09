const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout'),
    children: [
      { path: '', name: 'index', component: () => import('pages/Index') },
      { path: 'about', name: 'about', component: () => import('pages/About') },
    ]
  },
  {
    path: '/auth',
    component: () => import('layouts/AuthLayout'),
    children: [
      { path: 'login', name: 'login', meta: { guest: true }, component: () => import('pages/auth/Login') },
      { path: 'logout', name: 'logout', meta: { auth: true }, component: () => import('components/general/Logout') },
      { path: 'register', name: 'register', meta: { guest: true }, component: () => import('pages/auth/Register') },
      { path: 'password', name: 'password', component: { render: h => h('router-view') },
        children: [
          { path: 'forgot', name: 'password.forgot', meta: { guest: true }, component: () => import('pages/auth/Login') },
          { path: 'reset', name: 'password.reset', meta: { guest: true }, component: () => import('pages/auth/Login') }
        ]
      },
    ]
  },
  {
    path: '/dashboard',
    meta: { auth: true },
    component: () => import('layouts/DashboardLayout'),
    children: [
      { path: 'email/verify/:id/:hash', name: 'verify', meta: { auth: true }, component: () => import('pages/auth/Verification') },
      { path: '', name: 'dashboard.index', meta: { auth: true }, component: () => import('pages/dashboard/Index') },
      { path: 'profile', name: 'dashboard.profile', meta: { auth: true }, component: () => import('pages/dashboard/profile/Index') },
      { path: 'admin', name: 'dashboard.admin', meta: { auth: true, role: ['admin'] }, component: () => import('pages/dashboard/admin/Index') },
      { path: 'other', name: 'dashboard.other', meta: { auth: true, role: ['superadmin'] }, component: () => import('pages/dashboard/admin/Other') }
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
