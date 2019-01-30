<template>
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <router-link class="navbar-brand" to="/">LARA<span class="light">CRUD</span></router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="mainNav">
    <ul class="navbar-nav" v-for="link in links">
      <router-link active-class="active" tag="li" class="nav-item" :to="link.to" exact>
        <a class="nav-link">{{link.title}}</a>
      </router-link>
    </ul>
  </div>
</nav>
</template>
<style>
  .light {
    font-weight: 100;
  }
</style>
<script>
  export default {
    data() {
      return {
        links: [
          {
            title: 'Overzicht',
            to: '/'
          },
          {
            title: 'Artikel toevoegen',
            to: '/new'
          }
        ]
      }
    }
  }
</script>