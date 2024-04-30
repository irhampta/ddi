<script setup>
	import { Button } from "@/components/ui/button"
	import { ScrollArea } from "@/components/ui/scroll-area"
</script>

<template>
	<aside class="h-full w-64 flex-none flex flex-col bg-white border-e-2 border-slate-100">
		<ScrollArea class="h-full w-full p-8">
			<Button size="icon" variant="outline" class="mb-4" />
			<ul class="mb-4">
				<h1 class="font-semibold mb-1">Halaman</h1>
				<div class="flex flex-col">
					<router-link
						:to="{ name: 'dashboard' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Dashboard
					</router-link>
					<router-link
						:to="{ name: 'dashboard' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Website
					</router-link>
				</div>
			</ul>
			<ul class="mb-4">
				<h1 class="font-semibold mb-1">Post</h1>
				<div class="flex flex-col">
					<router-link :to="{ name: 'post' }" class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5" exactActiveClass="border-blue-500 ">
						Semua Post
					</router-link>
				</div>
			</ul>

			<ul class="mb-4">
				<h1 class="font-semibold mb-1">Direktori</h1>
				<div class="flex flex-col">
					<router-link
						:to="{ name: 'direktori' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Semua Pegawai
					</router-link>
					<router-link
						:to="{ name: 'tambah-pegawai' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Tambah Pegawai
					</router-link>
				</div>
			</ul>

			<ul class="mb-4">
				<h1 class="font-semibold mb-1">Galeri</h1>
				<div class="flex flex-col">
					<router-link
						:to="{ name: 'dashboard' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Avatar
					</router-link>
					<router-link
						:to="{ name: 'dashboard' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Lampiran Post
					</router-link>
					<router-link
						:to="{ name: 'dashboard' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Upload
					</router-link>
				</div>
			</ul>

			<ul class="mb-4">
				<h1 class="font-semibold mb-1">Pesan</h1>
				<div class="flex flex-col">
					<router-link
						:to="{ name: 'post' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Semua Pesan
					</router-link>
				</div>
			</ul>

			<ul class="mb-4">
				<h1 class="font-semibold mb-1">Setting</h1>
				<div class="flex flex-col">
					<router-link
						:to="{ name: 'post' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						Link
					</router-link>
					<router-link
						:to="{ name: 'dashboard' }"
						class="text-sm text-slate-700 hover:text-slate-900 border-l-2 hover:border-slate-600 ps-4 py-0.5"
						exactActiveClass="border-blue-500 text-blue-500 font-semibold hover:text-blue-400">
						QnA
					</router-link>
				</div>
			</ul>
		</ScrollArea>
	</aside>
</template>
