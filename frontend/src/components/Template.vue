<template>
  <div class="relative">
    <h6 v-if="!isGlobal">Название</h6>
    <InputText
      v-if="!isGlobal"
      class="w-full"
      type="text"
      placeholder="Название шаблона"
      v-model="template.name"
      @change="$emit('onChange')"
    />

    <h6>Заголовок</h6>

    <div
      v-for="(headline, index) in template.headlines"
      :key="index"
      class="p-inputgroup w-full my-1"
    >
      <InputText
        type="text"
        :placeholder="'Заголовок ' + (index + 1)"
        v-model="headline.value"
        @change="$emit('onChange')"
        @contextmenu="openMacrosMenu($event, headline, 'value')"
      />

      <Dropdown
        class="w-40"
        v-model="headline.pin"
        :options="pinList"
        optionLabel="name"
        optionValue="id"
        @change="$emit('onChange')"
      />

      <Button
        icon="pi pi-trash"
        class="p-button-danger"
        @click="deleteHeadline(index)"
      ></Button>
    </div>

    <Button
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addHeadline()"
    ></Button>

    <h6>Описание</h6>

    <div
      v-for="(description, index) in template.descriptions"
      :key="index"
      class="p-inputgroup w-full my-1"
    >
      <InputText
        type="text"
        :placeholder="'Описание ' + (index + 1)"
        v-model="description.value"
        @change="$emit('onChange')"
        @contextmenu="openMacrosMenu($event, description, 'value')"
      />

      <Dropdown
        class="w-40"
        v-model="description.pin"
        :options="pinList"
        optionLabel="name"
        optionValue="id"
        @change="$emit('onChange')"
      />

      <Button
        icon="pi pi-trash"
        class="p-button-danger"
        @click="deleteDescription(index)"
      ></Button>
    </div>

    <Button
      label="Добавить"
      icon="pi pi-plus"
      class="mt-2"
      @click="addDescription()"
    ></Button>

    <h6>Путь</h6>
    <InputText
      class="w-full"
      type="text"
      placeholder="Путь 1"
      v-model="template.path1"
      @change="$emit('onChange')"
      @contextmenu="openMacrosMenu($event, template, 'path1')"
    />

    <InputText
      class="w-full mt-1"
      type="text"
      placeholder="Путь 2"
      v-model="template.path2"
      @change="$emit('onChange')"
      @contextmenu="openMacrosMenu($event, template, 'path2')"
    />

    <ul
      ref="macrosMenu"
      id="right-click-menu"
      tabindex="-1"
      :style="{ top: top + 'px', left: left + 'px' }"
      @blur="closeMacrosMenu"
    >
      <li
        v-for="macros in macrosList"
        :key="macros"
        @click="addMacros(macros.value)"
      >
        {{ macros.name }}
      </li>
    </ul>
  </div>
</template>

<script>
const MINIMAL_HEADLINES = 1;
const MINIMAL_DESCRIPTIONS = 1;
const EMPTY_INPUT = { value: "", pin: 0 };

export default {
  methods: {
    openMacrosMenu(event, target, value) {
      event.preventDefault();

      let parentOffsetX = 0;
      let parentOffsetY = 0;

      let el = event.target;

      while (el.parentNode) {
        if (el.classList.contains("p-dialog")) {
          parentOffsetX += el.offsetLeft;
          parentOffsetY += el.offsetTop;
        }

        el = el.parentNode;
      }

      this.top = event.clientY - parentOffsetY;
      this.left = event.clientX - parentOffsetX;
      this.isShowMacrosMenu = true;
      this.$refs.macrosMenu.focus();

      this.currentMacrosTarget = target;
      this.currentMacrosValue = value;
    },

    closeMacrosMenu() {
      this.top = -9999;
      this.left = -9999;
      this.isShowMacrosMenu = false;
    },

    addMacros(value) {
      if (this.currentMacrosTarget[this.currentMacrosValue] === undefined) {
        this.currentMacrosTarget[this.currentMacrosValue] = value;
      } else {
        this.currentMacrosTarget[this.currentMacrosValue] += value;
      }

      this.closeMacrosMenu();
    },

    showWarning(message) {
      this.$toast.add({
        severity: "warn",
        summary: "Предупреждение",
        detail: message,
        life: 3000,
      });
    },

    addHeadline() {
      this.template.headlines.push({ ...EMPTY_INPUT });
      this.$emit("onChange");
    },

    deleteHeadline(index) {
      if (this.template.headlines.length <= MINIMAL_HEADLINES) {
        this.showWarning(
          "Минимальное количество заголовков = " + MINIMAL_HEADLINES
        );
        return;
      }

      this.template.headlines.splice(index, 1);
      this.$emit("onChange");
    },

    addDescription() {
      this.template.descriptions.push({ ...EMPTY_INPUT });
      this.$emit("onChange");
    },

    deleteDescription(index) {
      if (this.template.descriptions.length <= MINIMAL_DESCRIPTIONS) {
        this.showWarning(
          "Минимальное количество описаний = " + MINIMAL_DESCRIPTIONS
        );
        return;
      }

      this.template.descriptions.splice(index, 1);
      this.$emit("onChange");
    },
  },

  props: {
    templateLink: {
      type: Object,
      required: true,
    },

    isGlobal: {
      type: Boolean,
      default: true,
    },
  },

  data() {
    return {
      top: -9999,
      left: -9999,
      isShowMacrosMenu: false,
      currentMacrosTarget: null,
      currentMacrosValue: null,
      pinList: [
        {
          id: 0,
          name: "-",
        },
        {
          id: 1,
          name: "1",
        },
        {
          id: 2,
          name: "2",
        },
        {
          id: 3,
          name: "3",
        },
      ],

      macrosList: [
        {
          name: "Имя товара",
          value: "[NAME]",
        },
        {
          name: "Производитель",
          value: "[VENDOR]",
        },
        {
          name: "Цена",
          value: "[PRICE]",
        },
        {
          name: "URL ссылка",
          value: "[URL]",
        },
      ],

      profile: {},
    };
  },

  created() {
    this.template = this.templateLink;

    if (!this.template) {
      this.template = {};
    }

    if (this.template.name === undefined) {
      this.template.name = "";
    }

    if (this.template.categories === undefined) {
      this.template.categories = [];
    }

    if (this.template.headlines === undefined) {
      this.template.headlines = [{ ...EMPTY_INPUT }];
    }

    if (this.template.descriptions === undefined) {
      this.template.descriptions = [{ ...EMPTY_INPUT }];
    }
  },
};
</script>

<style scoped>
.w-40 {
  max-width: 110px;
}

#right-click-menu {
  background: #fafafa;
  border: 1px solid #bdbdbd;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
  display: block;
  list-style: none;
  margin: 0;
  padding: 0;
  position: fixed;
  width: 250px;
  z-index: 999999;
}

#right-click-menu li {
  border-bottom: 1px solid #e0e0e0;
  margin: 0;
  padding: 5px 35px;
  cursor: pointer;
}

#right-click-menu li:last-child {
  border-bottom: none;
}

#right-click-menu li:hover {
  background: #1e88e5;
  color: #fafafa;
}
</style>

