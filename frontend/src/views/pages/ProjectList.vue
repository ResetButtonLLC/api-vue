<template>
  <div>
    <div class="btnlist">
      <h2>Список проектов</h2>

      <Button label="Создать проект" icon="pi pi-plus" class="p-button-success" @click="navigateToCreate"></Button>
    </div>

    <div v-if="!projects.length">
      <h4 class="text-center mt-4">
        <div v-if="isProjectLoading">
          <i class="pi pi-spin pi-spinner" style="font-size:1.4rem"></i> Загрузка...
        </div>

        <div v-else>
          У вас нет доступных проектов
        </div>
      </h4>
    </div>

    <div v-else>
      <span class="p-float-label my-4">
        <InputText class="w-full" type="text" id="filter" v-model="filter" />
        <label for="filter">Название проекта</label>
      </span>

      <DataTable ref="dt" :value="filteredProjects" data-key="id" :paginator="true" :rows="10"
        paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
        :rowsPerPageOptions="[5, 10, 25]"
        currentPageReportTemplate="Показано от {first} до {last} из {totalRecords} проектов">
        <Column headerStyle="width: 4rem" field="id" header="ID" sortable></Column>

        <Column field="name" header="Название" sortable>
          <template #body="slotProps">
            <p class="profilelink" @click="navigateToProject(slotProps.data.id)">
              {{ slotProps.data.name }}
            </p>
          </template>
        </Column>

        <Column headerStyle="width: 10rem" header="Действия" bodyStyle="text-align: center">
          <template #body="slotProps">
            <!--
            <Button
              v-tooltip.top="'Редактировать'"
              icon="pi pi-pencil"
              class="p-button-rounded p-button-primary mr-2"
            />
            -->

            <Button v-tooltip.top="'Просмотр профилей'" icon="pi pi-eye" class="p-button-rounded p-button-success"
              @click="navigateToProject(slotProps.data.id)" />
          </template>
        </Column>
      </DataTable>
    </div>

    <CreateProjectDialog v-if="isShowCreateDialog" v-on:cancel="isShowCreateDialog = false" />
  </div>
</template>

<script>
import CreateProjectDialog from "@/components/CreateProjectDialog";

export default {
  components: {
    CreateProjectDialog,
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

    navigateToProject(id) {
      this.$store.dispatch("route", {
        name: "ProjectProfileList",
        params: { id: id },
      });
    },
  },

  computed: {
    projects() {
      return this.$store.getters.getProjects;
    },

    filteredProjects() {
      if (this.filter.length) {
        return this.projects.filter((el) => el.name.indexOf(this.filter) >= 0);
      } else return this.projects;
    },

    isProjectLoading() {
      return this.$store.getters.isProjectLoading;
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
