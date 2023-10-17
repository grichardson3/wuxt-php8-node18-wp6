<template>
  <main class="wp__content">
    <div v-html="this.frontPageContent"></div>
  </main>
</template>

<script>
  export default {
    async fetch(){
      const { route, app } = this.$nuxt.context;
      return await app.$wp.frontPage().get()
      // return await app.$wp.slug().name('hello-world')
      .then(res => {
        // BASIC EXAMPLE OF REASSIGNING DATA FROM $wp OBJECT
        // if statement reassigns either static page data, 
        // or data from the first post of latest posts
        if (Array.isArray(res)) {
          this.frontPageContent = res[0].content.rendered; // reassigns first post from latest posts
        } else {
          this.frontPageContent = res.content.rendered // reassigns static page contents
        }
      });
    },
    data(){
      return {
        frontPageContent: null
      }
    }
  }
</script>

<style lang="scss" scoped>
p {
  &:nth-child(1n + 2) {
    margin-top: 1rem;
  }
}

ul {
  margin-top: 1rem;

  li {
    &:nth-child(1n + 2) {
      margin-top: 1rem;
    }
  }
}

.bold {
  font-weight: 700;
}

.italic {
  font-style: italic;
}

code {
  padding: 3px 10px;

  background-color: #37495c;
  border-radius: 4px;

  color: #fff;
}
</style>
