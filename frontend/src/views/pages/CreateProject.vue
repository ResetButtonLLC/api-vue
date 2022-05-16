<template>
  <div>
    <h3>Создание проекта</h3>

    <span class="p-float-label mt-4">
      <InputText class="w-full" type="text" id="name" v-model="name" />
      <label for="name">Название проекта</label>
    </span>

    <Button
      label="Создать проект"
      icon="pi pi-save"
      class="mt-5"
      @click="addProject"
    ></Button>
  </div>
</template>

<script>
export default {
  props: ["id"],

  methods: {
    addProject() {
      this.$store.dispatch("createProject", this.name);
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
