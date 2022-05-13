  <template>
  <div>
    <Dialog
      :visible="true"
      :style="{ maxWidth: '100%', width: '750px' }"
      header="Редактирование брендов"
      :modal="true"
      class="p-fluid"
      :maximizable="true"
      @update:visible="$emit('close')"
    >
      <div class="text-center">
        <h5>Тип поведения брендов</h5>

        <SelectButton
          v-model="activeBehavior"
          :options="behaviorList"
          optionLabel="name"
          optionValue="value"
        />
      </div>

      <div class="savebtn">
        <Button
          label="Добавить бренд"
          icon="pi pi-plus"
          class="my-3 p-button-success"
          @click="isShowAddVendorDialog = true"
        ></Button>
      </div>

      <div class="text-center" v-if="!vendors.length">
        <p>В данной категории нет производителей</p>
      </div>

      <div
        v-else
        class="row"
        v-for="(vendor, index) in customVendors"
        :key="'category' + categoryId + '_vendor' + vendor.id"
      >
        <div class="name" :class="{ 'my-2': !isShowVendorParam }">
          <Checkbox
            @input="$emit('onChange')"
            v-model="vendor.is_active"
            :binary="true"
          />

          <p>{{ customVendorName(vendor.id) }}</p>
        </div>

        <div v-if="isShowVendorParam" class="keywords">
          <MultiSelect
            @change="$emit('onChange')"
            class="w-full"
            v-model="vendor.keyword_types"
            :options="keywordTypes"
            optionLabel="name"
            optionValue="id"
            :filter="true"
            placeholder="Без ключевых слов"
          />
        </div>

        <div v-if="isShowVendorParam" class="campaign">
          <Dropdown
            @change="$emit('onChange')"
            class="w-full"
            v-model="vendor.campaign"
            :options="campaignList"
            optionLabel="name"
            optionValue="id"
            placeholder="Кампания не выбрана"
          />
        </div>

        <span
          class="pi pi-times ml-3 close"
          @click="deleteVendorFromCustom(index)"
        ></span>
      </div>
    </Dialog>

    <AddVendorsDialog
      v-if="isShowAddVendorDialog"
      @save="addVendorsToCustom"
      @close="isShowAddVendorDialog = false"
      :vendorList="vendorList"
      :customVendorList="customVendors"
    />
  </div>
</template>


<script>
import {
  VENDOR_BEHAVIOR_OTHER_UNACTIVE,
  VENDOR_BEHAVIOR_OTHER_ACTIVE,
} from "../const/category";

import AddVendorsDialog from "./AddVendorsDialog";

export default {
  components: {
    AddVendorsDialog,
  },

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

    customVendorList: {
      type: Array,
      required: true,
    },
  },

  methods: {
    addVendorsToCustom(newVendors) {
      newVendors.forEach((el) => {
        this.customVendors.push({
          id: el,
          is_active: true,
        });
      });
    },

    deleteVendorFromCustom(index) {
      this.customVendors.splice(index, 1);
    },

    customVendorName(vendorId) {
      let vendor = this.vendors.find((el) => el.id == vendorId);
      return vendor ? vendor.name : "unknownVendor";
    },
  },

  created() {
    this.vendors = [...this.vendorList];
    this.customVendors = this.customVendorList;
  },

  data() {
    return {
      isShowAddVendorDialog: false,
      vendors: [],
      customVendors: [],

      activeBehavior: VENDOR_BEHAVIOR_OTHER_ACTIVE,
      behaviorList: [
        {
          name: "Недобавленные бренды активны и наследуют категорию",
          value: VENDOR_BEHAVIOR_OTHER_ACTIVE,
        },

        {
          name: "Недобавленные бренды неактивны",
          value: VENDOR_BEHAVIOR_OTHER_UNACTIVE,
        },
      ],
    };
  },

  computed: {
    isShowVendorParam() {
      return this.activeBehavior != VENDOR_BEHAVIOR_OTHER_ACTIVE;
    },
  },
};
</script>

<style scoped>
.close {
  color: white;
  background-color: #d90000;
  cursor: pointer;
  border: 1px solid;
  padding: 4px;
  border-radius: 55px;
}
</style>