<script setup>
	import { ScrollArea } from "@/components/ui/scroll-area"
	import { Separator } from "@/components/ui/separator"

	const props = defineProps({
		title: String,
		subtitle: String
	})
</script>

<template>
	<div class="flex-grow-0 w-full max-h-full flex flex-col bg-slate-50">
		<ScrollArea class="h-full w-full px-5">
			<slot></slot>
		</ScrollArea>
	</div>
</template>
