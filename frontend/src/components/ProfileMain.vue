<template>
  <div>
    <!--
    <h5>Основное:</h5>

    <span class="p-float-label mt-4">
      <InputText class="w-full" type="text" id="name" v-model="profile.name" />
      <label for="name">Имя</label>
    </span>
-->
    <h5>Настройки:</h5>
    <div class="box">
      <div class="el">
        <InputSwitch
          id="no_category_in_model"
          v-model="profile.settings.no_category_in_model"
        />
        <label for="no_category_in_model"
          >Вырезать название категории из названия модели</label
        >
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="
          'Если в названии модели будет найдено название категории - оно будет вырезано'
        "
      ></i>
    </div>

    <div class="box mt-4">
      <div class="el">
        <InputSwitch id="no_cyrillic" v-model="profile.settings.no_cyrillic" />
        <label for="no_cyrillic">Убрать кириллицу</label>
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="'Из названия будет вырезанна вся кириллица'"
      ></i>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      profile: {},
    };
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.settings === undefined) {
      this.profile.settings = {};
    }
  },
};
</script>

<style scoped>
.box {
  display: flex;
  align-items: center;
  width: 100%;
}

.box i {
  font-size: 1.4rem;
  color: var(--blue-400);
}

.el {
  flex: 1;
  display: flex;
  align-items: center;
}

.el label {
  margin-left: 10px;
}

.help {
  border: 1px solid var(--blue-400);
  padding: 10px;
  border-radius: 100px;
}
</style>