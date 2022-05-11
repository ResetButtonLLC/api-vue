<template>
  <div>
    <div class="infobox">
      <div class="switch">
        <InputSwitch
          id="no_category_in_model"
          v-model="profile.settings.no_category_in_model"
          @change="$emit('onChange')"
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

    <div class="infobox mt-4">
      <div class="switch">
        <InputSwitch
          id="no_cyrillic"
          v-model="profile.settings.no_cyrillic"
          @change="$emit('onChange')"
        />
        <label for="no_cyrillic"
          >Убрать кириллицу из тега [NAME] в объявлении</label
        >
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="'Из названия будет вырезанна вся кириллица'"
      ></i>
    </div>

    <div class="infobox mt-4">
      <div class="switch">
        <InputSwitch
          id="format_price"
          v-model="profile.settings.format_price"
          @change="$emit('onChange')"
        />
        <label for="format_price">Использовать форматирование цены</label>
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="'Через каждые 3 символа будет вставлен пробел'"
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

  created() {
    this.profile = this.profileLink;
  },
};
</script>