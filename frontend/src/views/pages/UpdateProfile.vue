<template>
  <div>
    <p v-if="isLoading">Загрузка...</p>

    <template v-else>
      <h3>Профиль {{ profile.name }} ({{ clientName }})</h3>

      <TabView scrollable>
        <TabPanel header="Основное">
          <ProfileMain :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Фид">
          <ProfileFeed :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Кампании">
          <ProfileCampaign :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Категории">
          <ProfileCategories :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Шаблоны">
          <ProfileTemplate :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Предпросмотр">
          <ProfilePreview :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Замены">
          <ProfileReplacement :profileLink="profile" />
        </TabPanel>
        <TabPanel header="Автообновления">
          <ProfileAutoupdate :profileLink="profile" />
        </TabPanel>
      </TabView>

      <Button
        label="Сохранить профиль"
        icon="pi pi-save"
        class="mt-5"
        @click="checkForSave"
      ></Button>
    </template>
  </div>
</template>

<script>
import ProfileMain from "@/components/ProfileMain";
import ProfileFeed from "@/components/ProfileFeed";
import ProfileTemplate from "@/components/ProfileTemplate";
import ProfileCampaign from "@/components/ProfileCampaign";
import ProfileCategories from "@/components/ProfileCategories";
import ProfilePreview from "@/components/ProfilePreview";
import ProfileReplacement from "@/components/ProfileReplacement";
import ProfileAutoupdate from "@/components/ProfileAutoupdate";

export default {
  components: {
    ProfileMain,
    ProfileFeed,
    ProfileTemplate,
    ProfileCampaign,
    ProfileCategories,
    ProfilePreview,
    ProfileReplacement,
    ProfileAutoupdate,
  },

  props: {
    id: {
      default: 0,
    },
  },

  data() {
    return {
      //profile: null,
    };
  },

  created() {
    //this.loadProfile();
  },

  methods: {
    loadProfile() {
      this.profile = this.$store.getters.getProfiles.find(
        (el) => el.id == this.id
      );

      console.log("loaded");
    },

    showSuccess(message) {
      this.$toast.add({
        severity: "success",
        summary: "Успешно",
        detail: message,
        life: 3000,
      });
    },

    showError(error) {
      this.$toast.add({
        severity: "error",
        summary: "Ошибка",
        detail: error,
        life: 3000,
      });
    },

    showErrorList(errorList) {
      let moreErrors = 0;

      if (errorList.length > 3) {
        moreErrors = errorList.length - 3;
        errorList.length = 3;
      }

      errorList.forEach((error) => {
        this.showError(error);
      });

      if (moreErrors) {
        this.showError("И еще ошибок: " + moreErrors);
      }
    },

    checkForSave() {
      let errorList = [];

      if (!this.profile.name) {
        errorList.push("Не указано имя профиля");
      }

      if (errorList.length) {
        this.showErrorList(errorList);
        return;
      }

      this.save();
    },

    save() {
      this.showSuccess("Профиль сохранен!");
    },
  },

  computed: {
    isLoading() {
      return this.profile === undefined;
    },

    profile() {
      return this.$store.getters.getProfiles.find((el) => el.id == this.id);
    },

    client() {
      return this.$store.getters.getClients.find(
        (el) => el.id == this.profile.client_id
      );
    },

    clientName() {
      return this.client && this.client.name ? this.client.name : "";
    },
  },
};
</script>