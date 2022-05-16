<template>
  <div>
    <div class="btnlist">
      <h2>Проект {{ projectName }}</h2>

      <Button
        label="Создать профиль"
        icon="pi pi-plus"
        class="p-button-success"
        @click="navigateToCreate"
      ></Button>
    </div>

    <div v-if="!profiles.length">
      <h2 class="text-center mt-4">{{ noProjectLabel }}</h2>
    </div>

    <div v-else>
      <span class="p-float-label my-4">
        <InputText class="w-full" type="text" id="filter" v-model="filter" />
        <label for="filter">Название проекта</label>
      </span>

      <DataTable
        ref="dt"
        :value="filteredProfiles"
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
              class="p-button-rounded p-button-warning mr-2"
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
      :projectId="id"
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
    },

    navigateToProfile(id) {
      this.$store.dispatch("route", {
        name: "Profile",
        params: {projectId: this.id, id: id },
      });
    },
  },

  computed: {
    project() {
      return this.$store.getters.getProjects.find((el) => el.id == this.id);
    },

    projectName() {
      return this.project && this.project.name ? this.project.name : "";
    },

    profiles() {
      return this.project && this.project.profiles ? this.project.profiles : [];
    },

    filteredProfiles() {
      if (this.filter.length) {
        return this.profiles.filter((el) => el.name.indexOf(this.filter) >= 0);
      } else return this.profiles;
    },

    noProjectLabel() {
      return this.project && this.profiles
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
