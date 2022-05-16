<template>
  <div>
    <h3>Создание профиля для проекта "{{ projectName }}"</h3>

    <span class="p-float-label mt-4">
      <InputText class="w-full" type="text" id="name" v-model="name" />
      <label for="name">Название профиля</label>
    </span>

    <Button
      label="Создать профиль"
      icon="pi pi-save"
      class="mt-5"
      @click="addProfile"
    ></Button>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      default: 0,
    },
    projectId: {
      required: true,
    },
  },

  data() {
    return {
      name: "",
    };
  },

  methods: {
    addProfile() {
      this.$store.dispatch("createProfile", {
        projectId: this.projectId,
        name: this.name,
      });
    },
  },

  computed: {
    project() {
      return this.$store.getters.getProjects.find(
        (el) => el.id == this.projectId
      );
    },

    projectName() {
      return this.project && this.project.name ? this.project.name : "";
    },
  },
};
</script>
