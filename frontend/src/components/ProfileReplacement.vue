<template>
  <div>
    <div class="box">
      <div class="el">
        <InputSwitch
          id="global_replacement"
          v-model="profile.settings.global_replacement"
        />
        <label for="global_replacement">Использовать глобальные замены</label>
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="
          'К дополнению к указанному вами списку будет использоваться список замен сформираванный администратором'
        "
      ></i>
    </div>

    <div
      v-for="(change, index) in profile.replacement"
      class="group"
      :key="change"
    >
      <span class="p-float-label mt-4 mr-2">
        <InputText class="w-full" type="text" id="from" v-model="change.from" />
        <label for="from">Что заменяем</label>
      </span>

      <span class="p-float-label mt-4 mx-2">
        <InputText class="w-full" type="text" id="to" v-model="change.to" />
        <label for="to">Чем заменяем</label>
      </span>

      <div>
        <Button
          icon="pi pi-trash"
          class="p-button-danger"
          @click="deleteReplacement(index)"
        ></Button>
      </div>
    </div>

    <Button
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addReplacement"
    ></Button>
  </div>
</template>

<script>
const EMPTY_REPLACEMENT = {
  from: "",
  to: "",
};

export default {
  methods: {
    addReplacement() {
      this.profile.replacement.push({ ...EMPTY_REPLACEMENT });
    },

    deleteReplacement(index) {
      this.profile.replacement.splice(index, 1);
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
      from: "",
      to: "",
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

.box {
  display: flex;
  align-items: center;
  width: 100%;
}

.box i {
  font-size: 1.4rem;
  color: var(--blue-400);
}

.el {
  flex: 1;
  display: flex;
  align-items: center;
}

.el label {
  margin-left: 10px;
}
</style>