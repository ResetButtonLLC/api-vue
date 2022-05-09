<template>
  <div>
    <h4>Автообновление</h4>

    <p>
      <i class="pi pi-info-circle"></i> Автообновление не будет работать, т.к.
      для этого нужно указать ссылку источника
    </p>

    <div class="group mt-4 mb-2">
      <InputSwitch
        id="autoupdate"
        v-model="profile.settings.autoupdate"
        @change="$emit('onChange')"
      />
      <label class="ml-2" for="autoupdate">Автообновление</label>
    </div>

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
          @input="$emit('onChange')"
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
      label="Добавить время автообновления"
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
      this.$emit("onChange");
    },

    deleteUpdate(index) {
      this.profile.autoupdates.splice(index, 1);
      this.$emit("onChange");
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

.group label {
  align-self: center;
}

.group span {
  flex: 1;
}

.group div {
  align-self: end;
}
</style>