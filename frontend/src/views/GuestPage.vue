<template>
  <Card
    v-if="!isAuthorized"
    class="
      sm:col-10 sm:col-offset-1
      m:col-8 m:col-offset-2
      lg:col-6 lg:col-offset-3
      text-center
      mt-8
    "
  >
    <template #title>Войдите в систему</template>
    <template #content>
      <Button
        label="Войти с помощью аккаунта Office365"
        icon="pi pi-microsoft"
        class="mt-1"
        @click="login"
      ></Button>
    </template>
  </Card>

  <div v-else>
    <h1 class="text-center">Вы успешно вошли в систему как {{ userName }}</h1>
  </div>
</template>

<script>
export default {
  created() {
    if (this.isAuthorized) {
      this.$router.push({
        name: "ProjectList",
      });
    }
  },

  methods: {
    login() {
      window.location = "/login";
    },
  },

  computed: {
    isAuthorized() {
      return this.$store.getters.isAuthorized;
    },

    userName() {
      return this.$store.getters.getUserName;
    },
  },
};
</script>