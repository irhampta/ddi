<script setup>
	import { onMounted, ref } from "vue"
	import axios from "axios"
	import { useAppSettingsStore } from "@/pinia/appSettings"
	import { RotateCcw, Loader2 } from "lucide-vue-next"
	import { h } from "vue"

	import { Button } from "@/components/ui/button"
	import { Separator } from "@/components/ui/separator"
	import { Card, CardContent, CardFooter } from "@/components/ui/card"
	import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
	import { Input } from "@/components/ui/input"
	import { ScrollArea } from "@/components/ui/scroll-area"
	import { useToast } from "@/components/ui/toast/use-toast"
	import { ToastAction } from "@/components/ui/toast"

	import { FormControl, FormErrorMessage, FormField, FormItem, FormLabel } from "@/components/ui/form"

	const { toast } = useToast()

	// pinia
	const appSettings = useAppSettingsStore()

	// axios settings
	axios.defaults.baseURL = appSettings.base_api_url
	axios.defaults.timeout = appSettings.base_api_url
	axios.defaults.headers = {
		Accept: "application/json"
	}

	const initialPegawai = {
		nama: "",
		email: "",
		jabatan: "staf",
		posisi: "",
		avatar: ""
	}

	const isLoading = ref(false)
	const pegawai = ref(initialPegawai)

	// error message
	const errors = ref({
		nama: undefined,
		email: undefined,
		jabatan: undefined,
		posisi: undefined,
		avatar: undefined
	})

	const handleFormReset = () => {
		pegawai.value.nama = ""
		pegawai.value.email = ""
		pegawai.value.jabatan = "staf"
		pegawai.value.posisi = ""
		pegawai.value.avatar = ""
	}

	const handleAddPegawai = async () => {
		isLoading.value = true
		await axios
			.post("pegawai", pegawai.value)
			.then(function (response) {
				if (response.status == 200 || response.status == 201) {
					handleFormReset()
					toast({
						title: "Berhasil",
						description: "Data " + pegawai.value.nama + " berhasil ditambahkan"
					})
				}
			})
			.catch(function (error) {
				if (error.response) {
					errors.value = error.response.data.messages
					toast({
						title: "Gagal",
						description: "Anda mengimput data tidak valid!",
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
									handleAddPegawai()
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

	onMounted(() => {
		$route.params.id
	})
</script>

<template>
	<div class="w-full flex-auto max-h-full flex flex-col">
		<!-- titlebar -->
		<div class="w-full h-20 flex-none px-5 flex items-center">
			<div class="flex flex-col justify-center me-auto">
				<span class="text-2xl">Ubah Data Pegawai</span>
				<span class="text-sm text-slate-500">Mengubah data pegawai pada daftar direktori pegawai</span>
			</div>
			<router-link :to="{ name: 'direktori' }">
				<Button variant="outline">Semua Pegawai</Button>
			</router-link>
		</div>

		<Separator />

		<!-- main -->
		<ScrollArea class="h-full w-full">
			<div class="flex-auto flex p-5">
				<!-- form create -->
				<Card class="w-full max-w-md">
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
		</ScrollArea>
	</div>
</template>
