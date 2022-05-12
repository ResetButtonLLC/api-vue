<template>
  <div>
    <h6>Статус</h6>
    <p v-if="isTypeUnset">
      <i class="pi pi-info-circle"></i> На данный момент фид еще не выбран
    </p>
    <p v-if="isTypeUrl">
      <i class="pi pi-info-circle"></i> Источником является фид загруженный по
      ссылке
    </p>
    <p v-if="isTypeFile">
      <i class="pi pi-info-circle"></i> Источником является файл который вы
      загрузили
    </p>

    <h6>Фид с внешнего источника</h6>
    <div class="p-float-label mt-4">
      <InputText
        class="w-full"
        type="text"
        id="feed_url"
        v-model="profile.feed_url"
        @change="$emit('onChange')"
      />
      <label for="feed_url">Ссылка на фид</label>
    </div>

    <span class="p-float-label mt-4">
      <InputText
        class="w-full"
        type="text"
        id="login"
        v-model="profile.login"
        @change="$emit('onChange')"
      />
      <label for="login">Логин</label>
    </span>

    <span class="p-float-label mt-4">
      <InputText
        class="w-full"
        type="text"
        id="password"
        v-model="profile.password"
        @change="$emit('onChange')"
      />
      <label for="password">Пароль</label>
    </span>

    <span class="p-float-label mt-4">
      <InputNumber
        class="w-full"
        id="min_count"
        v-model="profile.min_count"
        mode="decimal"
        @input="$emit('onChange')"
      />

      <label for="min_count">Минимальное количество товаров</label>
    </span>

    <h6>Файл фида</h6>
    <FileUpload
      chooseLabel="Выбрать"
      uploadLabel="Загрузить"
      cancelLabel="Отменить"
      :fileLimit="1"
      name="feed"
      :url="'/api/feed/upload/' + profile.id"
      @upload="onUpload"
      @change="$emit('onChange')"
    />

    <h6>Правила фильтрации при импорте товаров</h6>
    <Rules
      style="flex: 1; text-align: center"
      :objectLink="profile.import"
      conditionHelpText="Импортируем только товары соответствующие условиям"
    />

    <h6>Тонкая настройка полей</h6>

    <div class="switch">
      <InputSwitch
        id="use_custom_fields"
        v-model="profile.settings.use_custom_fields"
        :binary="true"
      />
      <label for="use_custom_fields">Использовать тонкую настройку полей</label>
    </div>

    <div class="mt-4" v-if="profile.settings.use_custom_fields">
      <div class="switch">
        <InputSwitch
          id="use_number_fields"
          v-model="profile.settings.use_number_fields"
          @change="$emit('onChange')"
          :binary="true"
        />
        <label for="use_number_fields"
          >Использовать нумерацию столбцов вместо названия (для .CSV)</label
        >
      </div>

      <CustomFields
        :numbersOnly="profile.settings.use_number_fields"
        :profileLink="profile"
        @onChange="$emit('onChange')"
      />
    </div>

    <div class="savebtn">
      <Button
        label="Сохранить изменения"
        icon="pi pi-save"
        class="mt-4 mb-4 p-button-success"
        @click="saveChanges"
      ></Button>
    </div>
  </div>
</template>

<script>
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
    };
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.import === undefined) {
      this.profile.import = {};
    }
  },

  methods: {
    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });
    },

    onUpload() {
      console.log("file uploaded");
    },
  },

  computed: {
    isTypeUnset() {
      return this.profile.feed_type == "unset";
    },

    isTypeUrl() {
      return this.profile.feed_type == "url";
    },

    isTypeFile() {
      return this.profile.feed_type == "file";
    },
  },
};
</script>