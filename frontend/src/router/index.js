import { createWebHistory, createRouter } from "vue-router"
import Dashboard from "@/views/Dashboard.vue"
import Direktori from "@/views/direktori/Direktori.vue"
import TambahPegawai from "@/views/direktori/TambahPegawai.vue"
import EditPegawai from "@/views/direktori/TambahPegawai.vue"

const routes = [
	{
		path: "/",
		name: "dashboard",
		component: Dashboard
	},

	{
		path: "/post",
		name: "post",
		component: Direktori
	},

	{
		path: "/direktori",
		children: [
			{ path: "", name: "direktori", component: Direktori },
			{ path: "tambah", name: "tambah-pegawai", component: TambahPegawai },
			{ path: "edit/:id", name: "edit-pegawai", component: EditPegawai }
		]
	},

	{
		path: "/ekstrakulikuler",
		name: "ekstrakulikuler",
		component: Direktori
	}
]

const router = createRouter({
	history: createWebHistory(),
	routes
})

export default router
