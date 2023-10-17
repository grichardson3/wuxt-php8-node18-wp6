<template>
    <div>
        <main class="wp__content">
            <div v-for="(post, index) in posts" :key="index">
              <nuxt-link :to=post.slug>
                <h2>{{ post.title }}</h2>
              </nuxt-link>
              <div v-html="post.excerpt"></div>
            </div>
        </main>
    </div>
</template>
  
  <script>
    export default {
      async fetch(){
        const { app } = this.$nuxt.context;
        return await app.$wp.posts().get()
        .then(res => {
          if (Array.isArray(res)) {
            res.forEach((item) => {
              this.posts.push({
                slug: 'posts/' + item.id,
                title: item.title.rendered,
                excerpt: item.excerpt.rendered
              });
            });
          }
        });
      },
      data(){
        return {
          posts: new Array()
        }
      }
    }
  </script>