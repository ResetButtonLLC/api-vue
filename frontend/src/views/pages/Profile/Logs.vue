<template>
  <div>
    <h4>Логи</h4>

    <DataTable :value="logs" :scrollable="true" scrollHeight="flex">
      <Column field="date" :sortable="true" header="Время"></Column>
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
          date: "12:00 11-11-2032",
          description:
            "Предоставление прав доступа пользователю Yana Kuznetcova",
        },

        {
          id: 1,
          date: "11:00 11-11-2032",
          description: "Запуска автообновления",
        },

        {
          id: 1,
          date: "10:00 11-11-2032",
          description: "Создание профиля",
        },
      ],
    };
  },

  created() {
    this.profile = { id: this.profileId };
  },

  methods: {},
};
</script>