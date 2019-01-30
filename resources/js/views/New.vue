<template>
	<div class="new">
		<h3 v-if="$route.params.id">Artikel bewerken</h3>
		<h3 v-else>Artikel toevoegen</h3>
		<form @submit="createOrUpdateArticle(article)">
			<div class="form-group">
				<label for="subject">Onderwerp</label>
				<input type="text" class="form-control" placeholder="Onderwerp" v-model="article.subject" id="subject" required>
			</div>
			<div class="form-group">
				<label for="author">Auteur</label>
				<input type="text" class="form-control" placeholder="Auteur" v-model="article.author" id="author" required>
			</div>
			<div class="form-group">
				<label for="category_id">Categorie</label>
				<select class="form-control" v-model="article.category_id" id="category_id" required>
					<option disabled>Kies een categorie</option>
					<option v-for="category in categories" :value="category.id">{{ category.title }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="body">Artikel</label>
				<textarea class="form-control" placeholder="Artikel" v-model="article.body" id="body" required/>
			</div>
			<input type="submit" class="btn btn-primary" :value="$route.params.id ? 'Opslaan' : 'Toevoegen'">
		</form>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				categories: [],
				article: {
					subject: '',
					author: '',
					category: '',
					body: ''
				}
			}
		},
		methods: {
			getCategories() {
				axios.get('/api/categories').then((r) => {
					this.$data.categories = r.data;
				}).catch((e) => {console.error('Error loading categories.', e)})
			},
			getArticle(id) {
				axios.get('/api/articles/'+id).then((r) => {
					if(r.status == 200) {
						// remove timestamps (we are not editing these)
						delete r.data.created_at;
						delete r.data.updated_at;

						// set data
						this.$data.article = r.data;
					}
				}).catch((e) => {console.error('Error loading article.', e)})
			},
			createArticle(article) {
				console.log(`Attempting to create ${article.subject}`);

				// create urlencoded querystring format
				let queryString = Object.keys(this.$data.article).map((key) => {
					return encodeURIComponent(key) +'='+ encodeURIComponent(this.$data.article[key])
				}).join('&');

				axios.post('/api/articles', queryString).then((r) => {
					// redirect to index on success (201: created)
					if(r.status = 201) {
						this.$router.push('/');
					}
				}).catch((e) => {console.error('Error creating article.', e)})
			},
			updateArticle(article) {
				console.log(`Attempting to update ${article.subject}`);

				// create urlencoded querystring format with article ID appended
				let queryString = Object.keys(this.$data.article).map((key) => {
					return encodeURIComponent(key) +'='+ encodeURIComponent(this.$data.article[key])
				}).join('&');

				axios.put('/api/articles/'+this.$route.params.id, queryString).then((r) => {
					if(r.status = 200) {
						this.$router.push('/');
					}
				}).catch((e) => {console.error('Error updating article.', e)})
			},
			createOrUpdateArticle(article) {
				if(this.$route.params.id) {
					this.updateArticle(article);
				} else {
					this.createArticle(article);
				}
			}
		},
		mounted() {
			this.getCategories();

			if(this.$route.params.id) {
				this.getArticle(this.$route.params.id);
			}
		}
	}
</script>