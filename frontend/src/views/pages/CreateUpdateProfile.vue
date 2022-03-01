<template>
  <div>
    <p>{{ isUpdate ? "update" : "create" }} profile</p>
    <p>{{ clientId }}</p>
  </div>
</template>

<script>
export default {
  props: ["clientId", "isCreate"],

  created() {
    if (this.isUpdate) {
      this.loadProfile();
    }
  },

  methods: {
    loadProfile() {
      console.log("loaded");
    },
  },

  computed: {
    isUpdate() {
      return this.isCreate ? false : true;
    },
  },
};
</script>