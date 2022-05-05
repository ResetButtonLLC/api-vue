<template>
  <div class="panel">
    <FilterCreator />
  </div>
</template>

<script>
import FilterCreator from "../components/FilterCreator";

export default {
  components: {
    FilterCreator,
  },

  data() {
    return {};
  },
};
</script>

<style scoped>
.panel {
  display: flex;
  justify-content: space-between;
}
</style>