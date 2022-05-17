<template>
  <div>
    <h4>Импорт и фильтрация</h4>

    <div v-if="isSettingsLoading">
      <p class="text-center">
        <i class="pi pi-spin pi-spinner"></i>
        Загрузка...
      </p>
    </div>

    <div v-else>
      <h6>Фид с внешнего источника</h6>
      <div class="p-float-label mt-4">
        <InputText class="w-full" type="text" id="feed_url" v-model="profile.settings.feed.url"
          @change="$emit('onChange')" />
        <label for="feed_url">Ссылка на фид</label>
      </div>

      <span class="p-float-label mt-4">
        <InputText class="w-full" type="text" id="login" v-model="profile.settings.feed.login"
          @change="$emit('onChange')" />
        <label for="login">Логин</label>
      </span>

      <span class="p-float-label mt-4">
        <InputText class="w-full" type="text" id="password" v-model="profile.settings.feed.password"
          @change="$emit('onChange')" />
        <label for="password">Пароль</label>
      </span>

      <span class="p-float-label mt-4">
        <InputNumber class="w-full" id="min_count" v-model="profile.settings.feed.min_count" mode="decimal"
          @input="$emit('onChange')" />

        <label for="min_count">Минимальное количество товаров</label>
      </span>

      <h6>Файл фида</h6>
      <FileUpload chooseLabel="Выбрать" uploadLabel="Загрузить" cancelLabel="Отменить" :fileLimit="1" name="feed"
        :url="'/api/feed/upload/' + profile.id" @upload="onUpload" @change="$emit('onChange')" />

      <h6>Правила фильтрации при импорте товаров</h6>
      <Rules style="flex: 1; text-align: center" :objectLink="profile.settings.import"
        conditionHelpText="Импортируем только товары соответствующие условиям" />

      <h6>Тонкая настройка полей</h6>

      <div class="switch">
        <InputSwitch id="use_custom_fields" v-model="profile.settings.fields.is_custom" :binary="true" />
        <label for="use_custom_fields">Использовать тонкую настройку полей</label>
      </div>

      <div class="mt-4" v-if="profile.settings.fields.is_custom">
        <div class="switch">
          <InputSwitch id="is_csv_number" v-model="profile.settings.fields.is_csv_number" @change="$emit('onChange')"
            :binary="true" />
          <label for="is_csv_number">Использовать нумерацию столбцов вместо названия (для .CSV)</label>
        </div>

        <CustomFields :numbersOnly="profile.settings.fields.is_csv_number" :profileLink="profile"
          @onChange="$emit('onChange')" />
      </div>

      <div class="savebtn">
        <Button label="Сохранить изменения" icon="pi pi-save" class="mt-4 mb-4 p-button-success"
          @click="saveChanges"></Button>
      </div>
    </div>
  </div>
</template>

<script>
import apiSettings from "@/api/apiSettings";
import CustomFields from "@/components/CustomFields";
import Rules from "@/components/Rules";

export default {
  components: {
    CustomFields,
    Rules,
  },

  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      profile: {},
      isSettingsLoading: false,
    };
  },

  created() {
    this.profile = this.profileLink;

    this.profile.settings = {};
    this.profile.settings.feed = {};
    this.profile.settings.import = {};
    this.profile.settings.fields = {};

    this.loadSettings();
  },

  methods: {
    loadSettings() {
      this.isSettingsLoading = true;
      apiSettings
        .getImportSettings(this.profile.id)
        .then((result) => {
          this.profile.settings = result.data.data;
        })
        .catch(() => {
          this.$store.dispatch("error", "Не удалось загрузить настройки");
        })
        .finally(() => {
          this.isSettingsLoading = false;
        });
    },

    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiSettings
        .setImportSettings(this.profile.id, this.profile.settings)
        .then(() => {
          this.$toast.add({
            severity: "success",
            summary: "Сохранено",
            detail: "Настройки сохранены",
            life: 3000,
          });
        })
        .catch(() => {
          this.$toast.add({
            severity: "error",
            summary: "Ошибка",
            detail: "Не удалось сохранить настройки",
            life: 3000,
          });
        });

      this.$emit("onSave");
    },

    onUpload() {
      console.log("file uploaded");
    },
  },
};
</script>