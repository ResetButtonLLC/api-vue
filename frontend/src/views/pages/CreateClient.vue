<template>
  <div>
    <h3>Создание клиента</h3>

    <span class="p-float-label mt-4">
      <InputText class="w-full" type="text" id="name" v-model="name" />
      <label for="name">Название клиента</label>
    </span>

    <Button
      label="Создать клиента"
      icon="pi pi-save"
      class="mt-5"
      @click="addClient"
    ></Button>
  </div>
</template>

<script>
export default {
  props: ["id"],

  methods: {
    addClient() {
      this.$store.dispatch("createClient", this.name);
    },
  },

  computed: {
    isUpdate() {
      return this.id ? true : false;
    },
  },

  data() {
    return {
      name: "",
    };
  },
};
</script>