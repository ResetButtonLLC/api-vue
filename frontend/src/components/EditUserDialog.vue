  <template>
    <Dialog :visible="true" :style="{ width: '450px' }" header="Редактирование пользователя" :modal="true"
        class="p-fluid" @update:visible="$emit('cancel')">
        <div class="field mt-5" v-if="!isProcessing">
            <span class="p-float-label">
                <InputText id="name" v-model.trim="name" required="true"
                    :class="{ 'p-invalid': isSubmitted && !name }" />
                <label for="name">Имя</label>
            </span>
            <small class="p-error" v-if="isSubmitted && !name">Имя обязательно</small>
        </div>

        <div v-else>
            <p class="text-center">
                <i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
            </p>
        </div>

        <template #footer>
            <Button v-if="!isProcessing" label="Сохранить" icon="pi pi-save" class="p-button-success"
                @click="saveUser" />
        </template>
    </Dialog>
</template>


<script>
export default {
    props: {
        userLink: {
            type: Object,
            required: true,
        }
    }
    ,

    created() {
        this.user = { ...this.userLink };
    },

    methods: {
        saveUser() {
            this.isSubmitted = true;
            this.isProcessing = true;

            this.$emit('onSave', this.user);
        }
    },

    data() {
        return {
            isProcessing: false,
            isSubmitted: false,
            user: {}
        };
    },
};
</script>
