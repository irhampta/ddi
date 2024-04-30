<script setup>
	import { ref, onMounted } from "vue"
	import axios from "axios"
	import { useAppSettingsStore } from "@/pinia/appSettings"
	import { h } from "vue"

	import BaseLayout from "@/components/layout/BaseLayout.vue"

	import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
	import { Table, TableBody, TableCell, TableRow } from "@/components/ui/table"
	import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
	import { Input } from "@/components/ui/input"
	import { Button } from "@/components/ui/button"
	import { Badge } from "@/components/ui/badge"
	import { Avatar, AvatarImage, AvatarFallback } from "@/components/ui/avatar"
	import { Loader2 } from "lucide-vue-next"

	import { FormControl, FormErrorMessage, FormField, FormItem, FormLabel } from "@/components/ui/form"

	import { useToast } from "@/components/ui/toast/use-toast"
	import { ToastAction } from "@/components/ui/toast"

	import { Trash2, Pencil, RotateCw, RotateCcw } from "lucide-vue-next"
	import Separator from "@/components/ui/separator/Separator.vue"

	const { toast } = useToast()

	// pinia
	const appSettings = useAppSettingsStore()

	// axios settings
	axios.defaults.baseURL = appSettings.base_api_url
	axios.defaults.timeout = appSettings.base_api_url
	axios.defaults.headers = {
		Accept: "application/json"
	}

	// error message
	const errors = ref({
		nama: undefined,
		email: undefined,
		jabatan: undefined,
		posisi: undefined,
		avatar: undefined
	})

	const pegawais = ref([])
	const pegawai = ref({
		nama: "",
		email: "",
		jabatan: "staf",
		posisi: "",
		avatar: ""
	})

	// state
	const isEditing = ref(false)
	const isLoading = ref(true)
	const isDeleting = ref(false)
	const isCreating = ref(false)
	const isUpdating = ref(false)

	function hadleNew() {
		isEditing.value = false
		pegawai.value.nama = ""
		pegawai.value.email = ""
		pegawai.value.jabatan = "staf"
		pegawai.value.posisi = ""
		pegawai.value.avatar = ""
	}

	function handleEditPegawai(selectedPpegawai) {
		isEditing.value = true
		pegawai.value.nama = selectedPpegawai.nama
		pegawai.value.email = selectedPpegawai.email
		pegawai.value.jabatan = selectedPpegawai.jabatan
		pegawai.value.posisi = selectedPpegawai.posisi
		pegawai.value.avatar = selectedPpegawai.avatar
	}

	const handleLoadPegawai = async () => {
		isLoading.value = true
		await axios
			.get("pegawai")
			.then(function (response) {
				if (response.status == 200) {
					pegawais.value = response.data.data.pegawai
				}
			})
			.catch(function (error) {
				if (error.response) {
					console.log(error.response.data.messages)
					toast({
						title: "Gagal",
						description: "Tidak dapat menemukan data",
						variant: "destructive"
					})
				} else if (error.request) {
					toast({
						title: "Error !",
						description: "Terjadi gangguan pada koneksi database!",
						variant: "destructive",
						action: h(
							ToastAction,
							{
								altText: "Coba Lagi",
								onClick: () => {
									handleLoadPegawai()
								}
							},
							{
								default: () => "Coba lagi"
							}
						)
					})
				}
			})
			.finally(function () {
				isLoading.value = false
			})
	}

	const handleDeletePegawai = async (pegawai) => {
		isDeleting.value = true
		await axios
			.delete("pegawai/" + pegawai.id)
			.then(function (response) {
				if (response.status == 200) {
					toast({
						title: "Berhasil",
						description: "Data " + pegawai.nama + " berhasil dihapus"
					})
					pegawais.value = pegawais.value.filter((item) => item.id !== pegawai.id)
				}
			})
			.catch(function (error) {
				if (error.response) {
					toast({
						title: "Gagal",
						description: "Data " + pegawai.nama + "tidak ditemukan"
					})
				} else if (error.request) {
					toast({
						title: "Error",
						description: "Terjadi Kesalahan : " + error.request
					})
				}
			})
			.finally(function () {
				isDeleting.value = false
			})
	}

	onMounted(() => {
		handleLoadPegawai()
	})
</script>

<template>
	<BaseLayout title="Direktori" subtitle="Daftar pegawai akan ditampilkan di direktori pegawai">
		<template v-slot:titlebaraction>
			<Button @click="handleLoadPegawai" :disabled="isLoading" variant="outline" size="icon" class="mr-4">
				<RotateCw size="16" :class="isLoading ? 'animate-spin' : ''" />
			</Button>
			<Button v-if="isEditing" variant="outline" @click="hadleNew()">Tambah Pegawai</Button>
		</template>

		<template v-slot:default>
			<div class="flex gap-5 flex-wrap-reverse items-end my-5 bg-white">
				<!-- table  -->
				<div class="flex-auto rounded-lg border border-slate-200">
					<Table>
						<TableBody>
							<TableRow v-for="(pegawai, index) in pegawais" :key="pegawai.id">
								<TableCell>
									<span class="text-slate-500">{{ index + 1 }}</span>
								</TableCell>
								<TableCell>
									<Avatar>
										<AvatarImage :src="pegawai.avatar != '' ? pegawai.avatar : 'default-avatar.png'" />
										<AvatarFallback>SI</AvatarFallback>
									</Avatar>
								</TableCell>
								<TableCell>
									<div class="flex flex-col">
										<p class="text-sm leading-5 text-slate-700">{{ pegawai.nama }}</p>
										<p class="text-xs leading-5 text-slate-500">{{ pegawai.email }}</p>
									</div>
								</TableCell>
								<TableCell>
									<Badge variant="secondary" v-if="pegawai.jabatan == 'pejabat'">pejabat</Badge>
									<Badge variant="secondary" v-else-if="pegawai.jabatan == 'guru'">guru</Badge>
									<Badge variant="secondary" v-else-if="pegawai.jabatan == 'staf'">staf</Badge>
								</TableCell>
								<TableCell>
									<p class="text-xs leading-5 text-slate-500">{{ pegawai.posisi }}</p>
								</TableCell>
								<TableCell class="text-right">
									<div class="flex gap-4 justify-end">
										<Button variant="outline" size="icon"><Pencil size="16" @click="handleEditPegawai(pegawai)" /></Button>
										<Button variant="destructive" size="icon" :disabled="isDeleting" @click="handleDeletePegawai(pegawai)"><Trash2 size="16" /></Button>
									</div>
								</TableCell>
							</TableRow>
						</TableBody>
					</Table>
				</div>

				<!-- form create or edit -->
				<Card class="w-full max-w-sm">
					<CardHeader v-if="isEditing">
						<CardTitle>Ubah Pegawai</CardTitle>
						<CardDescription>Memperbaharui data pegawai pada daftar direktori pegawai</CardDescription>
					</CardHeader>
					<CardHeader v-else>
						<CardTitle>Tambah Pegawai</CardTitle>
						<CardDescription>Menambah data pegawai baru pada daftar direktori pegawai</CardDescription>
					</CardHeader>
					<Separator />
					<CardContent class="pt-5">
						<form class="w-full space-y-5">
							<FormField name="nama">
								<FormItem v-auto-animate>
									<FormLabel>Nama Lengkap</FormLabel>
									<FormControl>
										<Input v-model="pegawai.nama" type="text" placeholder="Masukkan nama lengkap pegawai" />
									</FormControl>
									<FormErrorMessage :text="errors.nama" />
								</FormItem>
							</FormField>

							<FormField name="email">
								<FormItem v-auto-animate>
									<FormLabel>Email Aktif</FormLabel>
									<FormControl>
										<Input v-model="pegawai.email" type="email" placeholder="nama@gmail.com" />
									</FormControl>
									<FormErrorMessage :text="errors.email" />
								</FormItem>
							</FormField>

							<FormField name="jabatan">
								<FormItem v-auto-animate>
									<FormLabel>Jabatan</FormLabel>
									<FormControl>
										<Select v-model="pegawai.jabatan">
											<SelectTrigger id="jabatan">
												<SelectValue placeholder="Pilih" />
											</SelectTrigger>
											<SelectContent position="staf">
												<SelectItem value="pejabat"> Pejabat </SelectItem>
												<SelectItem value="guru"> Guru </SelectItem>
												<SelectItem value="staf"> Staf </SelectItem>
											</SelectContent>
										</Select>
									</FormControl>
									<FormErrorMessage :text="errors.jabatan" />
								</FormItem>
							</FormField>

							<FormField name="bagian">
								<FormItem v-auto-animate>
									<FormLabel>Posisi</FormLabel>
									<FormControl>
										<Input v-model="pegawai.posisi" type="text" placeholder="contoh : guru matematika" />
									</FormControl>
									<FormErrorMessage :text="errors.posisi" />
								</FormItem>
							</FormField>
						</form>
					</CardContent>

					<CardFooter class="pt-5">
						<div class="w-full flex">
							<Button @click="handleAddPegawai" :disabled="isLoading" class="mr-auto">
								<Loader2 v-if="isLoading" class="size-4 mr-2 animate-spin" />
								Tambah
							</Button>
							<Button @click="handleFormReset" variant="outline" size="icon"><RotateCcw size="16" /></Button>
						</div>
					</CardFooter>
				</Card>
			</div>
		</template>
	</BaseLayout>
</template>
