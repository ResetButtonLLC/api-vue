<template>
  <div>
    <h4>Кампании</h4>

    <p v-if="isNoCampaigns">
      <i class="pi pi-info-circle"></i> Нет загруженных данных о кампаниях
    </p>

    <Button
      label="Импортировать кампании"
      icon="pi pi-cloud-download"
      class="mt-2 mb-4"
      @click="showImportDialog"
    ></Button>

    <p v-if="isCampaignsLoading">Загрузка...</p>

    <DataTable
      v-else
      :value="campaignList"
      :scrollable="true"
      scrollHeight="flex"
    >
      <Column field="name" :sortable="true" header="Название"></Column>
      <Column field="googleId" :sortable="true" header="Google ID"></Column>
    </DataTable>

    <ImportCampaignDialog
      @cancel="hideImportDialog"
      @import="importCampaigns"
      :importedCampaigns="campaignList"
      :profileId="profile.id"
      v-if="isShowImportDialog"
    />
  </div>
</template>

<script>
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
    };
  },

  created() {
    this.profile = this.profileLink;

    this.$store.dispatch("getProfileCampaigns", {
      type: "imported",
      profileId: this.profile.id,
    });
  },

  methods: {
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