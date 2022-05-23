<template>
  <div class="card">
    <h4>Категории</h4>

    <div v-if="isCategoriesLoading || isCampaignsLoading">
      <p class="text-center">
        <i class="pi pi-spin pi-spinner"></i>
        Загрузка...
      </p>
    </div>

    <div v-else>
      <TableCategories :categoriesLink="categories" :campaignsLink="campaigns" :key="categories"
        @onChange="$emit('onChange')" />

      <div class="savebtn">
        <Button label="Сохранить изменения" icon="pi pi-save" class="mt-2 mb-4 p-button-success"
          @click="saveChanges"></Button>
      </div>
    </div>
  </div>
</template>

<script>
import apiCategory from "@/api/apiCategory";
import TableCategories from "@/components/TableCategories";

export default {
  components: {
    TableCategories,
  },

  props: ['profileId'],

  data() {
    return {
      profile: {},
    };
  },

  created() {
    this.profile = { id: this.profileId };

    this.$store.dispatch("getProfileCategories", this.profile.id);
    this.$store.dispatch("getProfileCampaigns", {
      type: "imported",
      profileId: this.profile.id,
    });
  },

  methods: {
    saveChanges() {
      this.$toast.add({
        severity: "info",
        summary: "В процессе",
        detail: "Отправляю запрос...",
        life: 3000,
      });

      apiCategory
        .setCategories(this.profile.id, this.categories)
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

  computed: {
    isCategoriesLoading() {
      return this.$store.getters.isCategoryLoadings(this.profile.id);
    },

    categories() {
      return this.$store.getters.getProfileCategories(this.profile.id);
    },

    campaigns() {
      return this.$store.getters.getProfileCampaigns(
        this.profile.id,
        "imported"
      );
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