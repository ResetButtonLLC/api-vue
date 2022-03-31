<template>
  <div>
    <h5>Автообновление</h5>
    <p>
      <i class="pi pi-info-circle"></i> Автообновление не будет работать, т.к.
      для этого нужно указать ссылку источника
    </p>

    <div
      v-for="(update, index) in profile.autoupdates"
      class="group w-full my-1"
      :key="index"
    >
      <span class="p-float-label mt-4 mr-2">
        <Calendar
          class="w-full"
          v-model="update.time"
          :showTime="true"
          :timeOnly="true"
        />
        <label>Время автообновления</label>
      </span>

      <div>
        <Button
          icon="pi pi-trash"
          class="p-button-danger"
          @click="deleteUpdate(index)"
        ></Button>
      </div>
    </div>

    <Button
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addUpdate"
    ></Button>
  </div>
</template>

<script>
const EMPTY_UDATE = {
  day: 0,
  time: null,
};

export default {
  methods: {
    addUpdate() {
      this.profile.autoupdates.push({ ...EMPTY_UDATE });
    },

    deleteUpdate(index) {
      this.profile.autoupdates.splice(index, 1);
    },
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
};
</script>

<style scoped>
.group {
  display: flex;
}

.group span {
  flex: 1;
}

.group div {
  align-self: end;
}
</style>