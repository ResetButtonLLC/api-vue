  <template>
  <Dialog
    :visible="true"
    :style="{ width: '450px' }"
    header="Создание профиля"
    :modal="true"
    class="p-fluid"
    @update:visible="$emit('cancel')"
  >
    <div class="field mt-5" v-if="!isProcessing">
      <span class="p-float-label">
        <InputText
          id="name"
          v-model.trim="name"
          required="true"
          :class="{ 'p-invalid': submitted && !name }"
        />
        <label for="name">Имя</label>
      </span>
      <small class="p-error" v-if="submitted && !name">Имя обязательно</small>
    </div>

    <div v-else>
      <p class="text-center">
        <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
      </p>
    </div>

    <template #footer>
      <Button
        v-if="!isProcessing"
        label="Сохранить"
        icon="pi pi-save"
        class="p-button-success"
        @click="addProfile"
      />
    </template>
  </Dialog>
</template>


<script>
export default {
  props: ["clientId"],

  methods: {
    addProfile() {
      this.submitted = true;

      if (!this.name) {
        return;
      }

      this.isProcessing = true;

      this.$store.dispatch("createProfile", {
        clientId: this.clientId,
        name: this.name,
      });
    },
  },

  data() {
    return {
      isProcessing: false,
      submitted: false,
      name: "",
    };
  },
};
</script>