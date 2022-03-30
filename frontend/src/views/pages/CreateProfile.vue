<template>
  <div>
    <h3>Создание профиля для клиента "{{ clientName }}"</h3>

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
    clientId: {
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
        clientId: this.clientId,
        name: this.name,
      });
    },
  },

  computed: {
    client() {
      return this.$store.getters.getClients.find(
        (el) => el.id == this.clientId
      );
    },

    clientName() {
      return this.client && this.client.name ? this.client.name : "";
    },
  },
};
</script>