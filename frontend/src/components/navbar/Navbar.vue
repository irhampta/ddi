<script setup>
	import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from "@/components/ui/dropdown-menu"
	import { Avatar, AvatarImage, AvatarFallback } from "@/components/ui/avatar"
</script>
<template>
	<header class="flex-shrink-0 w-full h-16 flex px-8">
		<nav class="flex gap-4 h-full flex-grow me-auto">
			<router-link :to="{ name: 'dashboard' }" class="flex items-center text-slate-500 hover:text-slate-700" activeClass="text-slate-900"> Dashboard </router-link>
			<router-link :to="{ name: 'direktori' }" class="flex items-center text-slate-500 hover:text-slate-700" activeClass="text-slate-900"> Direktori </router-link>
			<router-link :to="{ name: 'post' }" class="flex items-center text-slate-500 hover:text-slate-700" activeClass="text-slate-900"> Post </router-link>
			<router-link :to="{ name: 'ekstrakulikuler' }" class="flex items-center text-slate-500 hover:text-slate-700" activeClass="text-slate-900"> Ekstrakulikuler </router-link>
			<router-link :to="{ name: 'post' }" class="flex items-center text-slate-500 hover:text-slate-700" activeClass="text-slate-900"> Setting </router-link>
		</nav>
		<div class="flex-shrink-0 content-center">
			<DropdownMenu>
				<DropdownMenuTrigger class="size-8">
					<Avatar>
						<AvatarImage src="/default-avatar.png" />
						<AvatarFallback>SI</AvatarFallback>
					</Avatar>
				</DropdownMenuTrigger>
				<DropdownMenuContent class="w-48 me-5 mt-3">
					<DropdownMenuLabel>Akun</DropdownMenuLabel>
					<DropdownMenuSeparator />
					<DropdownMenuItem>Logout</DropdownMenuItem>
				</DropdownMenuContent>
			</DropdownMenu>
		</div>
	</header>
</template>
