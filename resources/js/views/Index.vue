<template>
	<div class="index">
		<div class="row">
			<div class="col-md-12">
				<h3>Overzicht</h3>
			</div>

			<template v-if="articles.length">
				<div v-for="(article, index) in articles" class="col-md-12 mb-3">
					<div class="card">
						<h3 class="card-header">
							<router-link :to="`/view/${article.id}`">{{ article.subject }}</router-link>
							<div class="btn-group float-right" role="group">
								<router-link :to="`/edit/${article.id}`" tag="button" class="btn btn-sm btn-info">Bewerken</router-link>
								<button @click="deleteArticle(article.id, index)" class="btn btn-sm btn-danger">Verwijderen</button>
							</div>							
						</h3>
						<div class="card-body">
							<h5 class="card-title">Op {{ parseDate(article.created_at) }} door <span class="badge badge-pill badge-secondary">{{ article.author }}</span></h5>
							<h6 v-if="typeof article.category != 'undefined'" class="card-subtitle text-muted">In <span class="badge badge-pill badge-primary">{{ article.category.title }}</span></h6>
						</div>
						<div class="card-body">
							<p class="card-text">{{ article.body }}</p>
							<router-link :to="`/view/${article.id}`" class="card-link">Lees meer...</router-link>
						</div>
					</div>
				</div>
			</template>
			<div v-else class="col-md-12">
				<p>Geen artikelen. <router-link to="/new">Artikel toevoegen</router-link>.</p>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				articles: [],
			}
		},
		mounted() {
			this.index();
		},
		methods: {
			parseDate(date) {
				let d = new Date(date);
				return `${d.getDate()}-${d.getMonth()+1}-${d.getFullYear()}`;
			},
			index() {
				axios.get('/api/articles').then((r) => {
					this.$data.articles = r.data;
				}).catch((e) => {
					console.error('Error getting articles.', e);
				})
			},
			deleteArticle(id, index) {
				axios.delete('/api/articles/'+id).then((r) => {
					if(r.status == 204) {
						// also delete the article on the client-side
						this.articles.splice(index, 1);
					}
				}).catch((e) => {
					console.error('Error deleting article.', e);
				})
			}
		}
	}
</script>