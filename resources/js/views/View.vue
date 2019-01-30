<template>
	<div class="about">
		<div class="row">
			<div class="col-md-12">
				<h3>{{ article.subject }} <small class="text-muted">door <span class="badge badge-pill badge-secondary">{{ article.author }}</span></small></h3>
				<p class="lead">Op {{ parseDate(article.created_at) }} <span v-if="typeof article.category != 'undefined'">in <span class="badge badge-pill badge-primary">{{ article.category.title }}</span></span></p>
			</div>
			<div class="col-md-12">
				<p>{{ article.body }}</p>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				article: {}
			}
		},
		methods: {
			parseDate(date) {
				let d = new Date(date);
				return `${d.getDate()}-${d.getMonth()+1}-${d.getFullYear()}`;
			},
			getArticle(id) {
				axios.get('/api/articles/'+id).then((r) => {
					if(r.status == 200) {
						// set data
						this.$data.article = r.data;
					}
				}).catch((e) => {console.error('Error loading article.', e)})
			}
		},
		mounted() {
			this.getArticle(this.$route.params.id);
		}
	}
</script>