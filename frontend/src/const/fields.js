const FIELD_LIST = [
    { value: "title" },
    { value: "description" },
    { value: "link" },
    { value: "image_link" },
    { value: "additional_image_link" },
    { value: "mobile_link" },
    { value: "availability" },
    { value: "availability_date" },
    { value: "cost_of_goods_sold" },
    { value: "expiration_date" },
    { value: "price" },
    { value: "sale_price" },
    { value: "sale_price_effective_date" },
    { value: "unit_pricing_base_measure" },
    { value: "installment" },
    { value: "subscription_cost" },
    { value: "loyalty_points" },
    { value: "google_product_category" },
    { value: "product_type" },
    { value: "brand" },
    { value: "gtin" },
    { value: "mpn" },
    { value: "identifier_exists" },
    { value: "condition" },
    { value: "adult" },
    { value: "multipack" },
    { value: "is_bundle" },
    { value: "energy_efficiency_class" },
    { value: "min_energy_efficiency_class" },
    { value: "max_energy_efficiency_class" },
    { value: "age_group" },
    { value: "color" },
    { value: "gender" },
    { value: "material" },
    { value: "pattern" },
    { value: "size" },
    { value: "size_type" },
    { value: "size_system" },
    { value: "item_group_id" },
    { value: "product_length" },
    { value: "product_width" },
    { value: "product_height" },
    { value: "product_weight" },
    { value: "product_detail" },
    { value: "product_highlight" },
    { value: "ads_redirect" },
    { value: "custom_label_0" },
    { value: "custom_label_1" },
    { value: "custom_label_2" },
    { value: "custom_label_3" },
    { value: "custom_label_4" },
    { value: "promotion_id" },
    { value: "excluded_destination" },
    { value: "included_destination" },
    { value: "shopping_ads_excluded_country" },
    { value: "shipping" },
    { value: "shipping_label" },
    { value: "shipping_weight" },
    { value: "shipping_length" },
    { value: "shipping_width" },
    { value: "shipping_height" },
    { value: "ships_from_country" },
    { value: "transit_time_label" },
    { value: "max_handling_time" },
    { value: "min_handling_time" },
    { value: "tax" },
    { value: "tax_category" },
];

const IMAGE_FIELD_LIST = [
    { value: "image_link" },
    { value: "additional_image_link" }
];

export default {
    getFieldFiullList() {
        return FIELD_LIST;
    },

    getFieldList() {
        return FIELD_LIST.map(el => {
            return el.value;
        });
    },

    getImageFieldList() {
        return IMAGE_FIELD_LIST.map(el => {
            return el.value;
        });
    }
}