<template>
  <div>
    <p>{{ isUpdate ? "update" : "create" }} client</p>
    <p>{{ id }}</p>
  </div>
</template>

<script>
export default {
  props: ["id"],

  created() {
    if (this.isUpdate) {
      this.loadClient();
    }
  },

  methods: {
    loadClient() {
      console.log("loaded");
    },
  },

  computed: {
    isUpdate() {
      return this.id ? true : false;
    },
  },
};
</script>