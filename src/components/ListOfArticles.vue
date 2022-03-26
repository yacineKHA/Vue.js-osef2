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
  grid-template-columns: 1fr 45% 1fr;
  background-color: #f1f1f1;
}

.articles-div {
  margin-top: 150px;
}

</style>