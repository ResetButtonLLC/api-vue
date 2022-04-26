<template>
  <div>
    <div class="btnlist">
      <h2>Клиент {{ clientName }}</h2>

      <Button
        label="Создать профиль"
        icon="pi pi-plus"
        class="p-button-success"
        @click="navigateToCreate"
      ></Button>
    </div>

    <div v-if="!profiles.length">
      <h2 class="text-center mt-4">{{ noClientLabel }}</h2>
    </div>

    <div v-else>
      <span class="p-float-label my-4">
        <InputText class="w-full" type="text" id="filter" v-model="filter" />
        <label for="filter">Название клиента</label>
      </span>

      <DataTable
        ref="dt"
        :value="filteredProfiles"
        data-key="id"
        :paginator="true"
        :rows="10"
        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
        :rowsPerPageOptions="[5, 10, 25]"
        currentPageReportTemplate="Показано от {first} до {last} из {totalRecords} клиентов"
      >
        <Column
          headerStyle="width: 4rem"
          field="id"
          header="ID"
          sortable
        ></Column>

        <Column field="name" header="Название" sortable>
          <template #body="slotProps">
            <p
              class="profilelink"
              @click="navigateToProfile(slotProps.data.id)"
            >
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
            <Button
              v-tooltip.top="'Клонировать'"
              icon="pi pi-link"
              class="p-button-rounded p-button-primary mr-2"
            />

            <Button
              v-tooltip.top="'Просмотреть'"
              icon="pi pi-eye"
              class="p-button-rounded p-button-success"
              @click="navigateToProfile(slotProps.data.id)"
            />
          </template>
        </Column>
      </DataTable>
    </div>

    <CreateProfileDialog
      :clientId="id"
      v-if="isShowCreateDialog"
      v-on:cancel="isShowCreateDialog = false"
    />
  </div>
</template>

<script>
import CreateProfileDialog from "@/components/CreateProfileDialog";

export default {
  components: {
    CreateProfileDialog,
  },

  data() {
    return {
      isShowCreateDialog: false,
      filter: "",
    };
  },

  props: {
    id: {
      default: 0,
    },
  },

  methods: {
    navigateToCreate() {
      this.isShowCreateDialog = true;
      /*
      this.$store.dispatch("route", {
        name: "CreateProfile",
        params: {
          clientId: this.client.id,
        },
      });
      */
    },

    navigateToProfile(id) {
      this.$store.dispatch("route", {
        name: "Profile",
        params: { clientId: this.id, id: id },
      });
    },
  },

  computed: {
    client() {
      return this.$store.getters.getClients.find((el) => el.id == this.id);
    },

    clientName() {
      return this.client && this.client.name ? this.client.name : "";
    },

    profiles() {
      return this.client && this.client.profiles ? this.client.profiles : [];
    },

    filteredProfiles() {
      if (this.filter.length) {
        return this.profiles.filter((el) => el.name.indexOf(this.filter) >= 0);
      } else return this.profiles;
    },

    noClientLabel() {
      return this.client && this.profiles
        ? "У вас нет доступных профилей"
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