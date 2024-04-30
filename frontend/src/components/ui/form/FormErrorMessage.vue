<script setup>
	const props = defineProps({
		text: String
	})
</script>

<template>
	<span class="text-xs text-red-500 dark:text-red-900">
		{{ text }}
	</span>
</template>
