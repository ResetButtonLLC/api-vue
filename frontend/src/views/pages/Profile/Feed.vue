<template>
  <div>
    <h4>Настройка источника</h4>

    <h6>Статус</h6>
    <p v-if="isTypeUnset">
      <i class="pi pi-info-circle"></i> На данный момент фид еще не выбран
    </p>
    <p v-if="isTypeUrl">
      <i class="pi pi-info-circle"></i> Источником является фид загруженный по
      ссылке
    </p>
    <p v-if="isTypeFile">
      <i class="pi pi-info-circle"></i> Источником является файл который вы
      загрузили
    </p>

    <h6>Ссылка на фид</h6>
    <div class="p-float-label mt-4">
      <InputText
        class="w-full"
        type="text"
        id="feed_url"
        v-model="profile.feed_url"
      />
      <label for="feed_url">Ссылка на фид</label>
    </div>

    <h6>Файл фида</h6>
    <FileUpload
      chooseLabel="Выбрать"
      uploadLabel="Загрузить"
      cancelLabel="Отменить"
      :fileLimit="1"
      name="feed"
      :url="'/api/feed/upload/' + profile.id"
      @upload="onUpload"
    />
  </div>
</template>

<script>
export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      profile: {},
    };
  },

  created() {
    this.profile = this.profileLink;
  },

  methods: {
    onUpload() {
      console.log("file uploaded");
    },
  },

  computed: {
    isTypeUnset() {
      return this.profile.feed_type == "unset";
    },

    isTypeUrl() {
      return this.profile.feed_type == "url";
    },

    isTypeFile() {
      return this.profile.feed_type == "file";
    },
  },
};
</script>