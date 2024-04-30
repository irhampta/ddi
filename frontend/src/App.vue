<script setup>
	import { Toaster } from "@/components/ui/toast"
	import { Separator } from "@/components/ui/separator"
	import Navbar from "./components/navbar/Navbar.vue"
</script>

<template>
	<div class="flex flex-col h-screen max-h-screen w-screen max-w-screen overflow-hidden">
		<Navbar />
		<Separator />
		<router-view />
	</div>
	<Toaster />
</template>
