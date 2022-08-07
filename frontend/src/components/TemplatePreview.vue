<template>
  <div>
    <div class="headers w-full">
      <p v-for="(headline, index) in template.headlines" :key="index">
        <span v-if="headline.pin">[{{ headline.pin }}] </span
        >{{ headline.value }}
      </p>
    </div>

    <div class="descriptions w-full mt-2">
      <p v-for="(description, index) in template.descriptions" :key="index">
        <span v-if="description.pin">[{{ description.pin }}] </span>
        {{ description.value }}
      </p>
    </div>

    <div v-if="template.path1 && template.path2" class="mt-2 path">
      {{ template.path1 }} / {{ template.path2 }}
    </div>
    <div v-if="template.path1 && !template.path2" class="mt-2 path">
      path1: {{ template.path1 }}
    </div>
    <div v-if="!template.path1 && template.path2" class="mt-2 path">
      path2: {{ template.path2 }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    templateLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      template: {},
    };
  },

  created() {
    this.template = this.templateLink;
  },
};
</script>

<style scoped>
.headers p {
  margin: 0;
  color: #7c7c7c;
}

.descriptions p {
  margin: 0;
  color: black;
}

.path {
  color: #7c7c7c;
}
</style>