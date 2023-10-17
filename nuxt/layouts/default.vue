<template>
  <div>
    <NavigationHeader/>
    <nuxt class="container"/>
  </div>
</template>

<script>

import NavigationHeader from '../components/templates/NavigationHeader.vue';

export default {
  components: {
      NavigationHeader
  }
}

</script>
