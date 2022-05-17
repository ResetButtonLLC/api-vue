<template>
  <div>
    <h4>Основное</h4>

    <div v-if="isSettingsLoading">
      <p class="text-center">
        <i class="pi pi-spin pi-spinner"></i>
        Загрузка...
      </p>
    </div>

    <div v-else>
      <div class="text-center">
        <SelectButton v-model="profile.settings.activity" :options="activityList" optionLabel="name" optionValue="value"
          @change="$emit('onChange')" />
      </div>

      <span class="p-float-label mt-5">
        <InputText class="w-full" type="text" id="google_id" v-model="profile.settings.google_id"
          @change="$emit('onChange')" />
        <label for="google_id">Google Ads ID</label>
      </span>

      <span class="p-float-label mt-4">
        <InputNumber class="w-full" id="bid" v-model="profile.settings.bid" mode="decimal" locale="ua-UA"
          :minFractionDigits="2" :maxFractionDigits="2" :step="0.01" @input="$emit('onChange')" />
        <!-- suffix="₴" -->

        <label for="bid">Ставка</label>
      </span>
    </div>

    <h4>Кампании</h4>

    <p v-if="isNoCampaigns && !isCampaignsLoading">
      <i class="pi pi-info-circle"></i> Нет загруженных данных о кампаниях
    </p>

    <p class="text-center" v-if="isCampaignsLoading">
      <i class="pi pi-spin pi-spinner"></i> Загрузка...
    </p>

    <div v-else>
      <Button label="Импортировать кампании" icon="pi pi-cloud-download" class="mt-2 mb-4"
        @click="showImportDialog"></Button>

      <DataTable :value="campaignList" :scrollable="true" scrollHeight="flex">
        <Column field="name" :sortable="true" header="Название"></Column>
        <Column field="googleId" :sortable="true" header="Google ID"></Column>
      </DataTable>

    </div>

    <ImportCampaignDialog @cancel="hideImportDialog" @import="importCampaigns" :importedCampaigns="campaignList"
      :profileId="profile.id" v-if="isShowImportDialog" />

    <div class="savebtn" v-if="!isCampaignsLoading && !isSettingsLoading">
      <Button label="Сохранить изменения" icon="pi pi-save" class="mt-4 mb-4 p-button-success"
        @click="saveChanges"></Button>
    </div>
  </div>
</template>

<script>
import apiSettings from "@/api/apiSettings";
import apiCampaign from "@/api/apiCampaign";
import ImportCampaignDialog from "@/components/ImportCampaignDialog";

export default {
  components: {
    ImportCampaignDialog,
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
      isShowImportDialog: false,
      isSettingsLoading: false,
      activityList: [
        { name: "Профиль активен", value: true },
        { name: "Профиль остановлен", value: false },
      ],
    };
  },

  created() {
    this.profile = this.profileLink;

    if (this.profile.settings === undefined) {
      this.profile.settings = {};
    }

    this.loadSettings();

    this.$store.dispatch("getProfileCampaigns", {
      type: "imported",
      profileId: this.profile.id,
    });
  },

  methods: {
    loadSettings() {
      this.isSettingsLoading = true;
      apiSettings
        .getMainSettings(this.profile.id)
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

      apiCampaign
        .setCampaigns(this.profile.id, this.campaignList)
        .then(() => {
          this.$toast.add({
            severity: "success",
            summary: "Сохранено",
            detail: "Кампании сохранены",
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

      apiSettings
        .setMainSettings(this.profile.id, this.profile.settings)
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

    hideImportDialog() {
      this.isShowImportDialog = false;
    },

    showImportDialog() {
      this.isShowImportDialog = true;
    },

    importCampaigns(campaigns) {
      campaigns.forEach((el) => {
        this.campaignList.push({ ...el });
      });

      this.hideImportDialog();

      this.$emit("onChange");
    },
  },

  computed: {
    campaignList() {
      return this.$store.getters.getProfileCampaigns(
        this.profile.id,
        "imported"
      );
    },

    isNoCampaigns() {
      return !this.campaignList.length;
    },

    isCampaignsLoading() {
      return this.$store.getters.isCampaignsLoadings(
        this.profile.id,
        "imported"
      );
    },
  },
};
</script>