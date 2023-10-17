<template>
    <main class="wp__content">
      <div>
        <h1>{{ pageTitle }}</h1>
        <div v-html="pageContent"></div>
      </div>
    </main>
  </template>
  
  <script>
    export default {
      async fetch(){
        const { route, app, error } = this.$nuxt.context;
        return await app.$wp.posts().id(route.params.id)
        .then(res => {
          // BASIC EXAMPLE OF REASSIGNING DATA FROM $wp OBJECT
          // this.pageContent = res.content.rendered // reassigns static page contents
          this.pageTitle = res.title.rendered
          this.pageContent = res.content.rendered
          
        });
      },
      data(){
        return {
          pageTitle: "",
          pageContent: ""
        }
      }
    }
  </script>