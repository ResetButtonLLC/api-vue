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
          style="max-width: 10rem"
          field="import"
          :sortable="true"
          header="Активность"
        >
          <template #body="slotProps">
            <InputSwitch
              :disabled="slotProps.data.imported"
              v-model="slotProps.data.import"
            />
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
    //this.markImportedCampaigns();

    this.$store.dispatch("getProfileCampaigns", {
      type: "all",
      profileId: this.profileId,
    });
  },

  methods: {
    processImport() {
      let campaigns = [];

      this.campaignList.forEach((el) => {
        if (el.import && !el.imported) {
          campaigns.push({ name: el.name, googleId: el.googleId });
        }
      });

      this.$emit("import", campaigns);
    },

    markImportedCampaigns() {
      this.campaignList.forEach((el) => {
        el.import = el.imported = false;

        this.importedCampaigns.forEach((already) => {
          if (el.name == already.name && el.googleId == already.googleId) {
            el.imported = el.import = true;
          }
        });
      });
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
      if (!this.filter) {
        return this.campaignList;
      }

      return this.campaignList.filter((el) => {
        return (
          el.googleId.toString().indexOf(this.filter) !== -1 ||
          el.name.toString().indexOf(this.filter) !== -1
        );
      });
    },
  },
};
</script>