import { createRouter, createWebHistory } from "vue-router";
import appointmentIndex from '../components/appointments/index.vue'
import appointmentCreate from '../components/appointments/create.vue'
import notFound from '../components/NotFound.vue'

const routes = [
	{
		path:'/appointment',
		component:appointmentIndex
	},
	{
		path:'/appointment/create',
		component:appointmentCreate
	},
	{
		path:'/:pathMatch(.*)*',
		component:notFound
	}
]

const router = createRouter({
	history: createWebHistory(),
	routes
})

export default router