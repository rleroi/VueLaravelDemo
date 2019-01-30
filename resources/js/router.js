import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/Index.vue'
import New from './views/New.vue'
import View from './views/View.vue'

Vue.use(Router)

let routes = new Router({
  //mode: 'history',
  //base: '',
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index,
    },
    {
      path: '/new',
      name: 'new',
      component: New,
    },
    {
      path: '/edit/:id',
      name: 'edit',
      component: New,
    },
    {
      path: '/view/:id',
      name: 'view',
      component: View,
    },

  ]
})

export default routes;
