  <template>
  <Dialog
    :visible="true"
    :style="{ maxWidth: '100%', width: '750px' }"
    header="Редактирование производителей"
    :modal="true"
    class="p-fluid"
    :maximizable="true"
    @update:visible="$emit('close')"
  >
    <Template :templateLink="template" />

    <template #footer>
      <Button
        v-if="!isProcessing"
        label="Сохранить"
        icon="pi pi-save"
        class="p-button-success"
        @click="addTemplate"
      />
    </template>
  </Dialog>
</template>


<script>
export default {
  data() {
    return {
      template: {},
    };
  },

  created() {},

  methods: {
    addTemplate() {
      this.$emit("save", this.template);
    },
  },
};
</script>