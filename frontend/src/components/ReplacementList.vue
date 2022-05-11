<template>
  <div>
    <div v-if="isLoading" class="text-center">
      <span><i class="pi pi-spin pi-spinner"></i> Загрузка</span>
    </div>

    <div v-else>
      <div class="text-center">
        <h5>{{ header }}</h5>

        <SelectButton
          v-model="activeType"
          :options="activityList"
          optionLabel="name"
          optionValue="value"
          @change="$emit('onChange')"
        />
      </div>

      <div class="copybtn mt-3 mb-1">
        <Button
          v-if="activeType == false"
          label="Скопировать глобальные значения в профиль"
          icon="pi pi-sync"
          class="p-button-sm p-button-info"
          @click="copyGlobal"
        ></Button>
      </div>

      <Textarea
        disabled
        v-if="activeType"
        class="w-full"
        :value="globalTextList"
        rows="15"
        cols="30"
        @input="this.$emit('onChange')"
      />

      <Textarea
        v-else
        class="w-full"
        v-model="profileTextList"
        rows="15"
        cols="30"
        @input="this.$emit('onChange')"
      />

      <div class="savebtn">
        <Button
          label="Сохранить изменения"
          icon="pi pi-save"
          class="mt-4 mb-4 p-button-success"
          @click="save"
        ></Button>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    header: {
      type: String,
      default: "",
    },

    isGlobal: {
      type: Boolean,
      default: true,
    },

    isLoading: {
      type: Boolean,
      default: false,
    },

    globalTextList: {
      type: String,
      default: "",
    },

    localTextList: {
      type: String,
      default: "",
    },
  },

  data() {
    return {
      activeType: this.isGlobal,
      profileTextList: this.localTextList,
      activityList: [
        { name: "Глобальные", value: true },
        { name: "Из профиля", value: false },
      ],
    };
  },

  methods: {
    copyGlobal() {
      let newValue = this.profileTextList + "\n" + this.globalTextList;

      this.profileTextList = newValue
        .split("\n")
        .filter((value) => value.length > 0)
        .filter((value, index, newArray) => newArray.indexOf(value) === index)
        .join("\n");

      this.$emit("onChange");
    },

    save() {
      this.$emit("onSave", {
        isGlobal: this.activeType,
        profileText: this.profileTextList,
      });
    },
  },

  computed: {},
};
</script>

<style scoped>
.copybtn {
  display: flex;
  justify-content: flex-end;
}
</style>