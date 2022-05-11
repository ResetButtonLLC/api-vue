<template>
  <Dialog
    :visible="true"
    :style="{ maxWidth: '100%', width: '750px' }"
    header="Добавление производителей"
    :modal="true"
    class="p-fluid"
    :maximizable="true"
    @update:visible="$emit('close')"
  >
    <MultiSelect
      class="w-full"
      v-model="selectedVendors"
      :options="vendorListForMultiselect"
      optionLabel="name"
      optionValue="id"
      :filter="true"
      placeholder="Ничего не добавлять"
    />

    <template #footer>
      <Button
        label="Добавить выбранные"
        icon="pi pi-save"
        class="p-button-success"
        @click="save"
      />
    </template>
  </Dialog>
</template>

<script>
export default {
  props: {
    vendorList: {
      type: Array,
      required: true,
    },

    customVendorList: {
      type: Array,
      required: true,
    },
  },

  data() {
    return {
      selectedVendors: [],
    };
  },

  methods: {
    save() {
      this.$emit("save", this.selectedVendors);
      this.$emit("close");
    },
  },

  computed: {
    vendorListForMultiselect() {
      let alreadyActiveList = this.customVendorList.map((el) => el.id);

      return this.vendorList.filter(
        (el) => alreadyActiveList.indexOf(el.id) === -1
      );
    },
  },
};
</script>