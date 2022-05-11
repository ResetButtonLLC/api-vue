<template>
  <div>
    <div class="text-center">
      <h5>Алгоритм генерации</h5>

      <SelectButton
        v-model="generateAlgorithm"
        :options="generateAlgorithmList"
        optionLabel="name"
        optionValue="value"
        @change="$emit('onChange')"
      />
    </div>

    <div class="infobox mt-4">
      <div class="switch">
        <InputSwitch
          id="split_after_comma"
          v-model="profile.settings.split_after_comma"
          @change="$emit('onChange')"
        />
        <label for="split_after_comma"
          >Обрезать текст после запятой в теге NAME</label
        >
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="
          'Если в теге NAME будет присутствовать запятая - запятая и все последующие данные будут отброшены'
        "
      ></i>
    </div>

    <div class="infobox mt-4">
      <div class="switch">
        <InputSwitch
          id="prefix_before_brand"
          v-model="profile.settings.prefix_before_brand"
          @change="$emit('onChange')"
        />
        <label for="prefix_before_brand"
          >Префикс перед брендом для ключей</label
        >
      </div>

      <i class="pi pi-question-circle" v-tooltip.left="'описание'"></i>
    </div>

    <div class="infobox mt-4">
      <div class="switch">
        <InputSwitch
          id="brakets_for_keys"
          v-model="profile.settings.brakets_for_keys"
          @change="$emit('onChange')"
        />
        <label for="brakets_for_keys">Данные в скобках для ключей</label>
      </div>

      <i class="pi pi-question-circle" v-tooltip.left="'описание'"></i>
    </div>

    <div class="infobox mt-4">
      <div class="switch">
        <InputSwitch
          id="delete_cyrillic_from_keys"
          v-model="profile.settings.delete_cyrillic_from_keys"
          @change="$emit('onChange')"
        />
        <label for="delete_cyrillic_from_keys"
          >Удалять кириллицу из ключей</label
        >
      </div>

      <i
        class="pi pi-question-circle"
        v-tooltip.left="
          'Слова состоящие из кирилличиских символов будут удалены. Бренд не удаляется.'
        "
      ></i>
    </div>
  </div>
</template>

<script>
const GENERATE_ALGORITHM_SIMPLE = 1;
const GENERATE_ALGORITHM_PROGRESSIVE = 2;

export default {
  props: {
    profileLink: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      generateAlgorithmList: [
        { name: "Простой", value: GENERATE_ALGORITHM_SIMPLE },
        { name: "Прогрессивный", value: GENERATE_ALGORITHM_PROGRESSIVE },
      ],
      generateAlgorithm: GENERATE_ALGORITHM_SIMPLE,
    };
  },

  created() {
    this.profile = this.profileLink;
  },
};
</script>