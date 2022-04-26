<template>
  <div>
    <h4>Кампании</h4>

    <p><i class="pi pi-info-circle"></i> Нет загруженных данных о кампаниях</p>

    <Button
      label="Импортировать список кампаний"
      icon="pi pi-cloud-download"
      class="mt-2"
    ></Button>
  </div>
</template>

<script>
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
  },

  methods: {},
};
</script>