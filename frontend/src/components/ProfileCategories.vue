<template>
  <div>
    <p>
      <i class="pi pi-info-circle"></i> Выбрать активные категории можно после
      загрузки фида
    </p>
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