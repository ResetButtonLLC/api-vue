<template>
  <div class="relative">
    <Button
      label="Настройка видимости полей"
      class="p-button-info"
      icon="pi pi-filter"
      @click="$refs.select.$el.click()"
    ></Button>
    <MultiSelect
      class="list"
      v-model="profile.previewActiveFields"
      :options="fieldList"
      optionLabel="name"
      optionValue="value"
      :filter="true"
      placeholder="Не показывать поля"
      ref="select"
    />
  </div>
</template>

<script>
import filterConst from "@/const/filter";

export default {
  props: ["previewFieldList", "profileLink"],

  created() {
    this.profile = this.profileLink;

    if (this.profile.previewActiveFields === undefined) {
      this.profile.previewActiveFields = [];

      this.fieldList.forEach((el) => {
        this.profile.previewActiveFields.push(el.value);
      });
    }
  },

  data() {
    return {
      profile: null,
    };
  },

  computed: {
    fieldList() {
      return filterConst.fieldList();
    },
  },
};
</script>

<style scoped>
.list {
  visibility: hidden;
  position: absolute;
  left: 0;
  top: 0;
  width: 1px;
  height: 1px;
}
</style>