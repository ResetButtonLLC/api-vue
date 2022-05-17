<template>
  <div>
    <div v-if="isSettingsLoading">
      <p>
        <i class="pi pi-spin pi-spinner"></i>
        Загрузка...
      </p>
    </div>

    <div v-else>
      <div class="text-center">
        <h5>
          Алгоритм генерации
          <i
            class="pi pi-question-circle mr-2"
            v-tooltip.bottom="
              'Простой алгоритм - он очень простой, но иногда может пригодиться\n\nПрогрессивный - более продвинутый, его используют чаще'
            "
          ></i>
        </h5>

        <SelectButton
          v-model="profile.settings.generate_algorithm"
          :options="generateAlgorithmList"
          optionLabel="name"
          optionValue="value"
          @change="$emit('onChange')"
        />
      </div>

      <div class="infobox mt-4">
        <div class="switch">
          <InputSwitch
            id="split_after_comma"
            v-model="profile.settings.split_after_comma"
            @change="$emit('onChange')"
          />
          <label for="split_after_comma"
            >Обрезать текст после запятой в теге NAME</label
          >
        </div>

        <i
          class="pi pi-question-circle"
          v-tooltip.left="
            'Если в теге NAME будет присутствовать запятая - запятая и все последующие данные будут отброшены'
          "
        ></i>
      </div>

      <div class="infobox mt-4">
        <div class="switch">
          <InputSwitch
            id="prefix_before_brand"
            v-model="profile.settings.prefix_before_brand"
            @change="$emit('onChange')"
          />
          <label for="prefix_before_brand"
            >Префикс перед брендом для ключей</label
          >
        </div>

        <i class="pi pi-question-circle" v-tooltip.left="'описание'"></i>
      </div>

      <div class="infobox mt-4">
        <div class="switch">
          <InputSwitch
            id="brakets_for_keys"
            v-model="profile.settings.brakets_for_keys"
            @change="$emit('onChange')"
          />
          <label for="brakets_for_keys">Данные в скобках для ключей</label>
        </div>

        <i class="pi pi-question-circle" v-tooltip.left="'описание'"></i>
      </div>

      <div class="infobox mt-4">
        <div class="switch">
          <InputSwitch
            id="delete_cyrillic_from_keys"
            v-model="profile.settings.delete_cyrillic_from_keys"
            @change="$emit('onChange')"
          />
          <label for="delete_cyrillic_from_keys"
            >Удалять кириллицу из ключей</label
          >
        </div>

        <i
          class="pi pi-question-circle"
          v-tooltip.left="
            'Слова состоящие из кирилличиских символов будут удалены. Бренд не удаляется.'
          "
        ></i>
      </div>

      <div class="savebtn">
        <Button
          class="mt-4 mb-2 p-button-success"
          label="Сохранить изменения"
          icon="pi pi-save"
          @click="saveChanges"
        ></Button>
      </div>
    </div>
  </div>
</template>

<script>
const GENERATE_ALGORITHM_SIMPLE = 1;
const GENERATE_ALGORITHM_PROGRESSIVE = 2;

import apiSettings from "@/api/apiSettings";

export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      generateAlgorithmList: [
        { name: "Простой", value: GENERATE_ALGORITHM_SIMPLE },
        { name: "Прогрессивный", value: GENERATE_ALGORITHM_PROGRESSIVE },
      ],
      profile: {},
      isSettingsLoading: false,
    };
  },

  created() {
    this.profile = this.profileLink;

    this.profile.settings = {};

    this.loadSettings();
  },

  methods: {
    loadSettings() {
      this.isSettingsLoading = true;
      apiSettings
        .getGenerateKeywordsSettings(this.profile.id)
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
        .setGenerateKeywordsSettings(this.profile.id, this.profile.settings)
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
  },
};
</script>