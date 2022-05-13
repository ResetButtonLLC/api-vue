<template>
  <div>
    <div class="btnlist">
      <h2>Список проектов</h2>

      <Button
        label="Создать проект"
        icon="pi pi-plus"
        class="p-button-success"
        @click="navigateToCreate"
      ></Button>
    </div>

    <div v-if="!clients.length">
      <h2 class="text-center mt-4">{{ noClientLabel }}</h2>
    </div>

    <div v-else>
      <span class="p-float-label my-4">
        <InputText class="w-full" type="text" id="filter" v-model="filter" />
        <label for="filter">Название проекта</label>
      </span>

      <DataTable
        ref="dt"
        :value="filteredClients"
        data-key="id"
        :paginator="true"
        :rows="10"
        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
        :rowsPerPageOptions="[5, 10, 25]"
        currentPageReportTemplate="Показано от {first} до {last} из {totalRecords} проектов"
      >
        <Column
          headerStyle="width: 4rem"
          field="id"
          header="ID"
          sortable
        ></Column>

        <Column field="name" header="Название" sortable>
          <template #body="slotProps">
            <p class="profilelink" @click="navigateToClient(slotProps.data.id)">
              {{ slotProps.data.name }}
            </p>
          </template>
        </Column>

        <Column
          headerStyle="width: 10rem"
          header="Действия"
          bodyStyle="text-align: center"
        >
          <template #body="slotProps">
            <!--
            <Button
              v-tooltip.top="'Редактировать'"
              icon="pi pi-pencil"
              class="p-button-rounded p-button-primary mr-2"
            />
            -->

            <Button
              v-tooltip.top="'Просмотр профилей'"
              icon="pi pi-eye"
              class="p-button-rounded p-button-success"
              @click="navigateToClient(slotProps.data.id)"
            />
          </template>
        </Column>
      </DataTable>
    </div>

    <CreateClientDialog
      v-if="isShowCreateDialog"
      v-on:cancel="isShowCreateDialog = false"
    />
  </div>
</template>

<script>
import CreateClientDialog from "@/components/CreateClientDialog";

export default {
  components: {
    CreateClientDialog,
  },

  data() {
    return {
      isShowCreateDialog: false,
      filter: "",
    };
  },

  methods: {
    navigateToCreate() {
      this.isShowCreateDialog = true;
    },

    navigateToClient(id) {
      this.$store.dispatch("route", {
        name: "ClientProfileList",
        params: { id: id },
      });
    },
  },

  computed: {
    clients() {
      return this.$store.getters.getClients;
    },

    filteredClients() {
      if (this.filter.length) {
        return this.clients.filter((el) => el.name.indexOf(this.filter) >= 0);
      } else return this.clients;
    },

    noClientLabel() {
      return this.$store.isClientLoaded
        ? "У вас нет доступных проектов"
        : "Загрузка...";
    },
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