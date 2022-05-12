<template>
  <Rules :objectLink="object" />
</template>

<script>
import Rules from "@/components/Rules";

export default {
  components: {
    Rules,
  },

  data() {
    return {
      object: {},
    };
  },

  methods: {},

  computed: {},
};
</script>