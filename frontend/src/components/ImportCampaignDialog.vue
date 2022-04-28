<template>
  <Dialog
    :visible="true"
    :style="{ maxWidth: '100%', width: '750px' }"
    header="Импорт кампаний"
    :modal="true"
    class="p-fluid"
    :maximizable="true"
    @update:visible="$emit('cancel')"
  >
    <div class="field mt-5" v-if="!isCampaignsLoading">
      <DataTable
        :value="filteredCampaignList"
        :scrollable="true"
        scrollHeight="flex"
      >
        <template #header>
          <InputText v-model="filter" placeholder="Фильтр" />
        </template>

        <Column
          style="max-width: 12rem"
          field="import"
          :sortable="true"
          header="Импортировать"
        >
          <template #body="slotProps">
            <InputSwitch v-model="slotProps.data.import" />
          </template>
        </Column>

        <Column field="name" :sortable="true" header="Название"></Column>
        <Column field="googleId" :sortable="true" header="Google ID"></Column>
      </DataTable>
    </div>

    <div v-else>
      <p class="text-center">
        <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
      </p>
    </div>

    <template #footer>
      <Button
        v-if="!isCampaignsLoading"
        label="Импортировать"
        icon="pi pi-save"
        class="p-button-success"
        @click="processImport"
      />
    </template>
  </Dialog>
</template>

<script>
export default {
  props: ["profileId", "importedCampaigns"],

  created() {
    this.$store.dispatch("getProfileCampaigns", {
      type: "all",
      profileId: this.profileId,
    });
  },

  methods: {
    processImport() {
      let campaigns = [];

      this.campaignList.forEach((el) => {
        if (el.import) {
          campaigns.push({ name: el.name, googleId: el.googleId });
        }
      });

      this.$emit("import", campaigns);
    },
  },

  data() {
    return {
      filter: "",
    };
  },

  computed: {
    campaignList() {
      return this.$store.getters.getProfileCampaigns(this.profileId, "all");
    },

    isCampaignsLoading() {
      return this.$store.getters.isCampaignsLoadings(this.profileId, "all");
    },

    filteredCampaignList() {
      let campaignWithoutImported = this.campaignList.filter((el) => {
        let notImported = true;

        this.importedCampaigns.forEach((imported) => {
          if (el.name == imported.name && el.googleId == imported.googleId) {
            notImported = false;
          }
        });

        return notImported;
      });

      if (!this.filter) {
        return campaignWithoutImported;
      }

      return campaignWithoutImported.filter((el) => {
        return (
          el.googleId.toString().indexOf(this.filter) !== -1 ||
          el.name.toString().indexOf(this.filter) !== -1
        );
      });
    },
  },
};
</script>