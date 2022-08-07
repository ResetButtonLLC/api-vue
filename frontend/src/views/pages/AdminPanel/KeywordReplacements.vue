<template>
    <div>
        <div v-if="isLoading">
            <p class="text-center">
                <i class="pi pi-spin pi-spinner"></i>
                Загрузка...
            </p>
        </div>

        <div v-else>
            <TabView scrollable>
                <TabPanel header="Бренды">
                    <Textarea class="w-full" :value="brandList" rows="15" cols="30" @input="onChange" />
                </TabPanel>

                <TabPanel header="Замены">
                    <Textarea class="w-full" :value="replacementList" rows="15" cols="30" @input="onChange" />
                </TabPanel>

                <TabPanel header="Цвета">
                    <Textarea class="w-full" :value="colorList" rows="15" cols="30" @input="onChange" />
                </TabPanel>

                <TabPanel header="Кривые кеи">
                    <Textarea class="w-full" :value="keyList" rows="15" cols="30" @input="onChange" />
                </TabPanel>
            </TabView>

            <div class="savebtn">
                <Button label="Сохранить изменения" icon="pi pi-save" class="mt-4 mb-4 p-button-success"
                    @click="save"></Button>
            </div>
        </div>
    </div>
</template>

<script>
import apiReplacement from "@/api/apiReplacement";

export default {
    data() {
        return {
            isLoading: false,
            brandList: '',
            replacementList: '',
            colorList: '',
            keyList: '',
        };
    },

    created() {
        this.load();
    },

    methods: {
        load() {
            this.isLoading = true;

            apiReplacement.getGlobalKeywordReplacements().then((result) => {
                this.brandList = result.data.data.brands;
                this.replacementList = result.data.data.replacement;
                this.colorList = result.data.data.colors;
                this.keyList = result.data.data.keys;
            }).catch(() => {
                this.$store.dispatch("error", "Не удалось загрузить замены");
            }).finally(() => {
                this.isLoading = false;
            });
        },

        save() {
            this.$toast.add({
                severity: "info",
                summary: "В процессе",
                detail: "Отправляю запрос...",
                life: 3000,
            });

            apiReplacement.setGlobalKeywordReplacements({
                brands: this.brandList,
                replacement: this.replacementList,
                colors: this.colorList,
                keys: this.keyList
            }).then(() => {
                this.$toast.add({
                    severity: "success",
                    summary: "Сохранено",
                    detail: "Настройки сохранены",
                    life: 3000,
                });
            })
                .catch(() => {
                    this.$toast.add({
                        severity: "error",
                        summary: "Ошибка",
                        detail: "Не удалось сохранить настройки",
                        life: 3000,
                    });
                });
        },

        onChange() {

        }
    },
};
</script>