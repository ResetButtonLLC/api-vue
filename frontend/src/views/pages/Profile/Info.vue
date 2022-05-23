<template>
  <div>
    <h4>Общая информация</h4>

    <div class="grid">
      <div class="col-12 lg:col-6 xl:col-3">
        <div class="card mb-0">
          <span class="block text-500 font-medium mb-3">Проект</span>
          <div class="text-900 font-medium text-xl">{{ projectName }}</div>
        </div>
      </div>

      <div class="col-12 lg:col-6 xl:col-3">
        <div class="card mb-0">
          <span class="block text-500 font-medium mb-3">Профиль</span>
          <div class="text-900 font-medium text-xl">{{ profileName }}</div>
        </div>
      </div>

      <div class="col-12 lg:col-6 xl:col-3">
        <div class="card mb-0">
          <span class="block text-500 font-medium mb-3">Активность</span>
          <div class="font-medium text-xl yes">Включен</div>
        </div>
      </div>

      <div class="col-12 lg:col-6 xl:col-3">
        <div class="card mb-0">
          <span class="block text-500 font-medium mb-3">Автообновление</span>
          <div class="font-medium text-xl no">Выключено</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['profileId'],

  data() {
    return {

    };
  },

  computed: {
    project() {
      return this.$store.getters.getProjectFromProfileId(this.profileId);
    },

    projectName() {
      return (this.project && this.project.name) ? this.project.name : 'Загрузка...';
    },

    profile() {
      return this.$store.getters.getProfileFromId(this.profileId);
    },

    profileName() {
      return (this.profile && this.profile.name) ? this.profile.name : 'Загрузка...';
    },
  },

  created() {
  },

  methods: {},
};
</script>

<style scoped>
.header {
  font-weight: 500;
}

.yes {
  color: rgb(0, 140, 55);
}

.no {
  color: rgb(170, 0, 0);
}
</style>
