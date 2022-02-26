<template>
  <section>
    <div></div>
    <div class="articles-div">
      <Articles/>
    </div>
    <div></div>
  </section>
</template>

<script>
import Articles from '@/components/Articles.vue';

export default {
  name: "home",
  components: {Articles},
}
</script>

<style scoped>
section {
  display: grid;
  grid-template-columns: 1fr 60% 1fr;
}

.articles-div {
  margin-top: 150px;
}

</style>