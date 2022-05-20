  <template>
    <Dialog :visible="true" :style="{ width: '450px' }" header="Редактирование значения" :modal="true" class="p-fluid"
        @update:visible="$emit('cancel')">

        <p v-if="isTypeUnknown">Неизвестный тип данных для редактирования</p>

        <InputText v-if="isTypeString" v-model="value" />

        <MultiSelect class="w-full" v-if="isTypeKeyType" v-model="value" :options="keywordTypes" optionLabel="name"
            optionValue="id" placeholder="Без ключевых слов" />

        <Dropdown class="w-full" v-if="isTypePin" v-model="value" :options="pinList" optionLabel="name"
            optionValue="value" placeholder="Не выбрано" />

        <template #footer>
            <Button label="Сохранить" icon="pi pi-save" class="p-button-success" @click="save" />
        </template>
    </Dialog>
</template>


<script>
import {
    TYPE_BOOLEAN,
    TYPE_STRING,
    TYPE_PIN,
    TYPE_KEY_TYPE,
} from "../const/filter";

import keywords from "../const/keywords";
import pins from "../const/pins";

export default {
    props: ['initValue', 'type'],

    methods: {
        save() {
            this.$emit('save', this.value);
        }
    },

    data() {
        return {
            value: this.initValue
        };
    },

    computed: {
        isTypeUnknown() {
            return !this.type;
        },

        isTypeBoolean() {
            return this.type == TYPE_BOOLEAN;
        },

        isTypeString() {
            return this.type == TYPE_STRING;
        },

        isTypePin() {
            return this.type == TYPE_PIN;
        },

        isTypeKeyType() {
            return this.type == TYPE_KEY_TYPE;
        },

        keywordTypes() {
            return keywords.keywords();
        },

        pinList() {
            return pins.list();
        },
    }
};
</script>
