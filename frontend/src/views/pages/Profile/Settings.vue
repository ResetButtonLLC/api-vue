<template>
  <div>
    <h4>Настройки</h4>

    <TabView scrollable>
      <TabPanel header="Основное">
        <span class="p-float-label mt-3">
          <InputText
            class="w-full"
            type="text"
            id="google_id"
            v-model="profile.google_id"
          />
          <label for="google_id">Google Ads ID</label>
        </span>

        <span class="p-float-label mt-4">
          <InputText
            class="w-full"
            type="text"
            id="url"
            v-model="profile.url"
          />
          <label for="url">URL</label>
        </span>
      </TabPanel>

      <TabPanel header="Финансы">
        <span class="p-float-label mt-3">
          <InputNumber
            class="w-full"
            id="bid"
            v-model="profile.bid"
            mode="decimal"
            locale="ua-UA"
            :minFractionDigits="2"
            :maxFractionDigits="2"
            :step="0.01"
          />
          <!-- suffix="₴" -->

          <label for="bid">Ставка</label>
        </span>
      </TabPanel>

      <TabPanel header="Импорт">
        <span class="p-float-label mt-3">
          <InputNumber
            class="w-full"
            id="min_price"
            v-model="profile.min_price"
            mode="currency"
            locale="ua-UA"
            :maxFractionDigits="0"
            :step="1"
            currency="UAH"
          />

          <label for="min_price">Минимальная цена продукта</label>
        </span>

        <span class="p-float-label mt-4">
          <InputNumber
            class="w-full"
            id="max_price"
            v-model="profile.max_price"
            mode="currency"
            locale="ua-UA"
            :maxFractionDigits="0"
            :step="1"
            currency="UAH"
          />

          <label for="max_price">Максимальная цена продукта</label>
        </span>
      </TabPanel>

      <TabPanel header="Генерация">
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
            <InputSwitch
              id="no_cyrillic"
              v-model="profile.settings.no_cyrillic"
            />
            <label for="no_cyrillic">Убрать кириллицу</label>
          </div>

          <i
            class="pi pi-question-circle"
            v-tooltip.left="'Из названия будет вырезанна вся кириллица'"
          ></i>
        </div>
      </TabPanel>
    </TabView>

    <Button
      class="mt-4"
      label="Сохранить изменения"
      icon="pi pi-save"
      @click="saveChanges"
    ></Button>
  </div>
</template>

<script>
import apiProfiles from "@/api/apiProfiles";

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

    if (this.profile.google_id == 0) {
      this.profile.google_id = "";
    }

    if (!this.profile.bid) {
      this.profile.bid = 0.01;
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

      apiProfiles
        .setSettings(this.profile.id, this.profile.settings)
        .then(() => {
          this.$toast.add({
            severity: "success",
            summary: "Сохранено",
            detail: "Успешно сохранено",
            life: 3000,
          });
        })
        .catch(() => {
          this.$toast.add({
            severity: "error",
            summary: "Ошибка",
            detail: "Не удалось сохранить",
            life: 3000,
          });
        });
    },
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