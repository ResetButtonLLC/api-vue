  <template>
  <Dialog
    :visible="true"
    :style="{ maxWidth: '100%', width: '750px' }"
    header="Редактирование производителей"
    :modal="true"
    class="p-fluid"
    :maximizable="true"
    @update:visible="$emit('close')"
  >
    <div class="text-center" v-if="!vendors.length">
      <p>В данной категории нет производителей</p>
    </div>

    <div
      v-else
      class="row"
      v-for="vendor in vendors"
      :key="'category' + categoryId + '_vendor' + vendor.id"
    >
      <div class="name">
        <Checkbox
          @input="
            $emit('changeCheckbox', { categoryId: categoryId, event: $event })
          "
          v-model="vendor.is_active"
          :binary="true"
        />
        <p>{{ vendor.name }}</p>
      </div>

      <div class="keywords">
        <MultiSelect
          class="w-full"
          v-model="vendor.keyword_types"
          :options="keywordTypes"
          optionLabel="name"
          optionValue="id"
          :filter="true"
          placeholder="Без ключевых слов"
        />
      </div>

      <div class="campaign">
        <Dropdown
          class="w-full"
          v-model="vendor.campaign"
          :options="campaignList"
          optionLabel="name"
          optionValue="id"
          placeholder="Кампания не выбрана"
        />
      </div>
    </div>
  </Dialog>
</template>


<script>
export default {
  props: {
    keywordTypes: {
      type: Array,
      required: true,
    },

    campaignList: {
      type: Array,
      required: true,
    },

    categoryId: {
      type: Number,
      required: true,
    },

    vendorList: {
      type: Array,
      required: true,
    },
  },

  created() {
    this.vendors = [...this.vendorList];
  },

  data() {
    return {
      vendors: [],
    };
  },
};
</script>