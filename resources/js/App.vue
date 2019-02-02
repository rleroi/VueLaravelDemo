<template>
	<div class="app">
		<Navbar/>
		<div class="container">
			<transition name="opacity" mode="out-in" appear>
				<router-view/>
			</transition>
		</div>
	</div>
</template>
<style>
	body {
		padding-top: 120px;
	}
	.opacity-enter,
	.opacity-leave-to {
		opacity: 0;
	}
	.opacity-enter-to,
	.opacity-leave {
		opacity: 1;
	}
	.opacity-leave-active,
	.opacity-enter-active {
		transition: opacity 100ms ease;
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