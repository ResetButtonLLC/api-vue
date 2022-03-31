<template>
  <div>
    <p>
      <i class="pi pi-info-circle"></i> Выбрать активные категории можно после
      загрузки фида
    </p>

    <TableCategories />
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
  },

  methods: {},
};
</script>