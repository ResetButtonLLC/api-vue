<template>
    <div>
        <div v-if="isUserLoading">
            <i class="pi pi-spin pi-spinner" style="font-size:1.4rem"></i> Загрузка...
        </div>

        <div v-else>
            <span class="p-float-label my-4">
                <InputText class="w-full" type="text" id="filter" v-model="filter" />
                <label for="filter">Имя пользователя</label>
            </span>

            <DataTable ref="dt" :value="filteredUsers" data-key="id" :paginator="true" :rows="10"
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                :rowsPerPageOptions="[5, 10, 25]"
                currentPageReportTemplate="Показано от {first} до {last} из {totalRecords} проектов">
                <Column headerStyle="width: 4rem" field="id" header="ID" sortable></Column>
                <Column field="name" header="Имя" sortable />
                <Column field="role" header="Роль" sortable />
                <Column field="clients" header="Клиенты" sortable />
                <Column headerStyle="width: 10rem" header="Действия" bodyStyle="text-align: center">
                    <template #body="slotProps">
                        <Button v-tooltip.top="'Редактировать'" icon="pi pi-pencil"
                            class="p-button-rounded p-button-primary mr-2" @click="openEditDialog(slotProps.data.id)" />
                    </template>
                </Column>
            </DataTable>
        </div>

        <EditUserDialog v-if="currentUser" @cancel="closeEditDialog" @onSave="saveUser" :userLink="currentUser" />
    </div>
</template>

<script>
import EditUserDialog from "@/components/EditUserDialog";

export default {
    components: {
        EditUserDialog,
    },

    data() {
        return {
            currentUser: null,
            filter: "",
        };
    },

    methods: {
        openEditDialog(userId) {
            this.currentUser = this.users.find((user) => user.id == userId);
        },

        closeEditDialog() {
            this.currentUser = null;
        },

        saveUser(user) {
            this.currentUser = { ...user };
        },
    },

    computed: {
        users() {
            return [];
        },

        filteredUsers() {
            if (this.filter.length) {
                return this.users.filter((el) => el.name.indexOf(this.filter) >= 0);
            } else return this.users;
        },

        isUserLoading() {
            return false;
        }
    },
};
</script>

<style scoped>
.btnlist {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btnlist h2 {
    margin: 0;
}

.profilelink {
    cursor: pointer;
    font-weight: 600;
}
</style>
