<template>
  <div>
    <h5>Автообновление</h5>
    <p>
      <i class="pi pi-info-circle"></i> Автообновление не будет работать, т.к.
      для этого нужно указать ссылку источника
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