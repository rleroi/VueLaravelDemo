<template>
	<div class="app">
		<Navbar/>
		<div class="container">
			<router-view/>
		</div>
	</div>
</template>
<style>
	body {
		padding-top: 120px;
	}
</style>
<script>
	import Navbar from './components/Navbar.vue'
	export default {
		components: {Navbar},
		mounted() {
		}
	}
</script>