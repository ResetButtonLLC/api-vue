<template>
  <div>
    <DataTable :value="logs" :scrollable="true" scrollHeight="flex">
      <Column field="start" :sortable="true" header="Начало"></Column>
      <Column field="end" :sortable="true" header="Конец">
        <template #body="slotProps">
          <div class="group now" v-if="!slotProps.data.end">
            <i class="pi pi-spin pi-spinner"> </i>
            <p>В процессе</p>
          </div>

          <div v-else>
            {{ slotProps.data.end }}
          </div>
        </template>
      </Column>
      <Column field="result" :sortable="true" header="Результат">
        <template #body="slotProps">
          <div class="group yes" v-if="slotProps.data.result">
            <i class="pi pi-check-circle"> </i>
            <p>Успешно</p>
          </div>

          <div class="group no" v-if="!slotProps.data.result && slotProps.data.end">
            <i class="pi pi-times-circle"> </i>
            <p>Ошибка</p>
          </div>
        </template>
      </Column>
      <Column field="description" :sortable="true" header="Описание"></Column>
    </DataTable>
  </div>
</template>

<script>
export default {
  props: ['profileId'],

  data() {
    return {
      profile: {},
      logs: [
        {
          id: 1,
          start: "12:00 11-11-2032",
          end: null,
          result: false,
          description: "",
        },

        {
          id: 1,
          start: "11:00 11-11-2032",
          end: "11:15 11-11-2032",
          result: true,
          description: "",
        },

        {
          id: 1,
          start: "10:00 11-11-2032",
          end: "10:00 11-11-2032",
          result: false,
          description: "Не удалось загрузить фид",
        },
      ],
    };
  },

  created() {
    this.profile = { id: this.profileId };

    if (this.profile.settings === undefined) {
      this.profile.settings = {};
    }

    if (this.profile.autoupdate == 0) {
      this.profile.autoupdate = false;
    }
  },
};
</script>

<style scoped>
.group {
  display: flex;
  align-items: center;
}

.group i {
  margin-right: 7px;
}

.yes {
  color: rgb(0, 140, 55);
}

.no {
  color: rgb(170, 0, 0);
}

.now {
  color: rgb(240, 140, 0);
}
</style>