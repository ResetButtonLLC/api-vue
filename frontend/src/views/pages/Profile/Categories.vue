<template>
  <div>
    <h4>Категории</h4>

    <p>
      <i class="pi pi-info-circle"></i> Выбрать активные категории можно после
      загрузки фида
    </p>

    <p v-if="isCategoriesLoading || isCampaignsLoading">Загрузка...</p>
    <TableCategories
      v-else
      :categoriesLink="categories"
      :campaignsLink="campaigns"
      :key="categories"
    />
  </div>
</template>

<script>
import TableCategories from "@/components/TableCategories";

export default {
  components: {
    TableCategories,
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

    this.$store.dispatch("getProfileCategories", this.profile.id);
    this.$store.dispatch("getProfileCampaigns", {
      type: "imported",
      profileId: this.profile.id,
    });
  },

  methods: {},

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