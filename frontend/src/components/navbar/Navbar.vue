<script setup>
	import {
		NavigationMenu,
		NavigationMenuContent,
		NavigationMenuItem,
		NavigationMenuLink,
		NavigationMenuList,
		NavigationMenuTrigger,
		navigationMenuTriggerStyle
	} from "@/components/ui/navigation-menu"
	import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from "@/components/ui/dropdown-menu"
	import { Avatar, AvatarImage, AvatarFallback } from "@/components/ui/avatar"
</script>
<template>
	<header class="flex-shrink-0 w-full h-16 flex px-8">
		<nav class="flex gap-4 h-full flex-grow me-auto">
			<router-link
				:to="{ name: 'dashboard' }"
				class="translate-y-[1px] flex items-center text-slate-700 hover:text-slate-900 border-b hover:border-slate-700"
				exactActiveClass="border-sky-500 hover:border-sky-500 text-sky-500 hover:text-sky-500">
				Dashboard
			</router-link>
			<router-link
				:to="{ name: 'direktori' }"
				class="translate-y-[1px] flex items-center text-slate-700 hover:text-slate-900 border-b hover:border-slate-700"
				exactActiveClass="border-sky-500 hover:border-sky-500 text-sky-500 hover:text-sky-500">
				Direktori
			</router-link>
			<router-link
				:to="{ name: 'post' }"
				class="translate-y-[1px] flex items-center text-slate-700 hover:text-slate-900 border-b hover:border-slate-700"
				exactActiveClass="border-sky-500 hover:border-sky-500 text-sky-500 hover:text-sky-500">
				Post
			</router-link>
			<router-link
				:to="{ name: 'ekstrakulikuler' }"
				class="translate-y-[1px] flex items-center text-slate-700 hover:text-slate-900 border-b hover:border-slate-700"
				exactActiveClass="border-sky-500 hover:border-sky-500 text-sky-500 hover:text-sky-500">
				Ekstrakulikuler
			</router-link>
			<router-link
				:to="{ name: 'post' }"
				class="translate-y-[1px] flex items-center text-slate-700 hover:text-slate-900 border-b hover:border-slate-700"
				exactActiveClass="border-sky-500 hover:border-sky-500 text-sky-500 hover:text-sky-500">
				Setting
			</router-link>
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
