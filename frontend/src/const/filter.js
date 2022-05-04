//VALUES
export const VALUE_NONE = 0;
export const VALUE_BOOLEAN = 1;
export const VALUE1_INT = 2;
export const VALUE2_INT = 4;
export const VALUE1_STR = 8;
export const VALUE2_STR = 16;
export const VALUE1_DATE = 32;
export const VALUE2_DATE = 64;
export const VALUE_KEY_TYPE = 128;
export const VALUE_AD_EDIT_STATUS = 256;

// OPERATORS
export const OPERATOR_STR_CONTAIN = { name: 'Содержит', value: 'contain', type: [VALUE1_STR], default: ['', null], allowNull: false };
export const OPERATOR_STR_NOT_CONTAIN = { name: 'Не содержит', value: '!contain', type: [VALUE1_STR], default: ['', null], allowNull: false };
export const OPERATOR_STR_EQUAL = { name: 'Равно', value: 's=', type: [VALUE1_STR], default: ['', null], allowNull: true };
export const OPERATOR_STR_NOT_EQUAL = { name: 'Не равно', value: 's!=', type: [VALUE1_STR], default: ['', null], allowNull: true };
export const OPERATOR_STR_START_WITH = { name: 'Начинается на', value: 'start_with', type: [VALUE1_STR], default: ['', null], allowNull: false };
export const OPERATOR_STR_END_WITH = { name: 'Заканчивается на', value: 'end_with', type: [VALUE1_STR], default: ['', null], allowNull: false };
export const OPERATOR_STR_NOT_START_WITH = { name: 'Не начинается на', value: '!start_with', type: [VALUE1_STR], default: ['', null], allowNull: false };
export const OPERATOR_STR_NOT_END_WITH = { name: 'Не заканчивается на', value: '!end_with', type: [VALUE1_STR], default: ['', null], allowNull: false };
export const OPERATORS_STRING = [
    OPERATOR_STR_CONTAIN,
    OPERATOR_STR_NOT_CONTAIN,
    OPERATOR_STR_EQUAL,
    OPERATOR_STR_NOT_EQUAL,
    OPERATOR_STR_START_WITH,
    OPERATOR_STR_END_WITH,
    OPERATOR_STR_NOT_START_WITH,
    OPERATOR_STR_NOT_END_WITH
];

export const OPERATOR_INT_EQUAL = { name: 'Равно', value: 'i=', type: [VALUE1_INT], default: [0, null], allowNull: false };
export const OPERATOR_INT_NOT_EQUAL = { name: 'Не равно', value: 'i!=', type: [VALUE1_INT], default: [0, null], allowNull: false };
export const OPERATOR_INT_GREATER_THAN = { name: 'Больше', value: 'i>', type: [VALUE1_INT], default: [0, null], allowNull: false };
export const OPERATOR_INT_LOWER_THAN = { name: 'Меньше', value: 'i<', type: [VALUE1_INT], default: [0, null], allowNull: false };
export const OPERATOR_INT_GREATER_OR_EQUAL_THAN = { name: 'Больше или равно', value: 'i>=', type: [VALUE1_INT], default: [0, null], allowNull: false };
export const OPERATOR_INT_LOWER_OR_EQUAL_THAN = { name: 'Меньше или равно', value: 'i<=', type: [VALUE1_INT], default: [0, null], allowNull: false };
export const OPERATOR_INT_IN_RANGE = { name: 'В диапазоне', value: 'i-range', type: [VALUE1_INT, VALUE2_INT], default: [0, 0], allowNull: false };
export const OPERATORS_INTEGER = [
    OPERATOR_INT_EQUAL,
    OPERATOR_INT_NOT_EQUAL,
    OPERATOR_INT_GREATER_THAN,
    OPERATOR_INT_LOWER_THAN,
    OPERATOR_INT_GREATER_OR_EQUAL_THAN,
    OPERATOR_INT_LOWER_OR_EQUAL_THAN,
    OPERATOR_INT_IN_RANGE
];

export const OPERATOR_BOOLEAN_EQUAL = { name: 'Равно', value: 'b=', type: [VALUE_BOOLEAN], default: [false, null], allowNull: true };
export const OPERATOR_BOOLEAN_NOT_EQUAL = { name: 'Не равно', value: 'b!=', type: [VALUE_BOOLEAN], default: [false, null], allowNull: true };
export const OPERATORS_BOOLEAN = [
    OPERATOR_BOOLEAN_EQUAL,
    OPERATOR_BOOLEAN_NOT_EQUAL
];

export const OPERATOR_AD_EDIT_STATUS_EQUAL = { name: 'Равно', value: 'aes=', type: [VALUE_AD_EDIT_STATUS], default: [null, null], allowNull: false };
export const OPERATOR_AD_EDIT_STATUS_NOT_EQUAL = { name: 'Не равно', value: 'aes!=', type: [VALUE_AD_EDIT_STATUS], default: [null, null], allowNull: false };
export const OPERATORS_AD_EDIT_STATUS = [
    OPERATOR_AD_EDIT_STATUS_EQUAL,
    OPERATOR_AD_EDIT_STATUS_NOT_EQUAL
];

export const OPERATOR_KEY_TYPE_EQUAL = { name: 'Равно', value: 'kt=', type: [VALUE_KEY_TYPE], default: [null, null], allowNull: false };
export const OPERATOR_KEY_TYPE_NOT_EQUAL = { name: 'Не равно', value: 'kt!=', type: [VALUE_KEY_TYPE], default: [null, null], allowNull: false };
export const OPERATORS_KEY_TYPE = [
    OPERATOR_KEY_TYPE_EQUAL,
    OPERATOR_KEY_TYPE_NOT_EQUAL
];

export const OPERATOR_DATE_EQUAL = { name: 'Равно', value: 'd=', type: [VALUE1_DATE], default: [null, null], allowNull: false };
export const OPERATOR_DATE_NOT_EQUAL = { name: 'Не равно', value: 'd!=', type: [VALUE1_DATE], default: [null, null], allowNull: false };
export const OPERATOR_DATE_GREATER_THAN = { name: 'После', value: 'd>', type: [VALUE1_DATE], default: [null, null], allowNull: false };
export const OPERATOR_DATE_LOWER_THAN = { name: 'До', value: 'd<', type: [VALUE1_DATE], default: [null, null], allowNull: false };
export const OPERATOR_DATE_GREATER_OR_EQUAL_THAN = { name: 'После (включительно)', value: 'd>=', type: [VALUE1_DATE], default: [null, null], allowNull: false };
export const OPERATOR_DATE_LOWER_OR_EQUAL_THAN = { name: 'До (включительно)', value: 'd<=', type: [VALUE1_DATE], default: [null, null], allowNull: false };
export const OPERATOR_DATE_IN_RANGE = { name: 'В диапазоне', value: 'd-range', type: [VALUE1_DATE, VALUE2_DATE], default: [null, null], allowNull: false };
export const OPERATORS_DATE = [
    OPERATOR_DATE_EQUAL,
    OPERATOR_DATE_NOT_EQUAL,
    OPERATOR_DATE_GREATER_THAN,
    OPERATOR_DATE_LOWER_THAN,
    OPERATOR_DATE_GREATER_OR_EQUAL_THAN,
    OPERATOR_DATE_LOWER_OR_EQUAL_THAN,
    OPERATOR_DATE_IN_RANGE
];

// FIELDS
export const FIELD_HEADLINE1 = { name: 'Заголовок', value: 'headline1', operators: OPERATORS_STRING };
export const FIELD_DESCRIPTION1 = { name: 'Описание', value: 'description1', operators: OPERATORS_STRING };

export const FIELD_PATH1 = { name: 'Путь1', value: 'path1', operators: OPERATORS_STRING };
export const FIELD_PATH2 = { name: 'Путь2', value: 'path2', operators: OPERATORS_STRING };
export const FIELD_PRICE = { name: 'Цена', value: 'price', operators: OPERATORS_INTEGER };
//export const FIELD_GROUP_STATUS = { name: 'Статус группи', value: 'group_status', operators: OPERATORS_BOOLEAN };
export const FIELD_GOOGLE_ID = { name: 'Google ID', value: 'googleid', operators: OPERATORS_INTEGER };
export const FIELD_URL = { name: 'URL', value: 'url', operators: OPERATORS_STRING };
export const FIELD_KEY_TYPE = { name: 'Тип ключа', value: 'keytype', operators: OPERATORS_KEY_TYPE };

function fieldList() {
    return [
        FIELD_HEADLINE1,
        FIELD_DESCRIPTION1,
        FIELD_GOOGLE_ID,
        FIELD_KEY_TYPE,
        FIELD_PATH1,
        FIELD_PATH2,
        FIELD_PRICE,
        FIELD_URL
    ];
}

function operatorList() {
    return [].concat(
        OPERATORS_STRING,
        OPERATORS_INTEGER,
        OPERATORS_BOOLEAN,
        OPERATORS_DATE,
        OPERATORS_KEY_TYPE,
        OPERATORS_AD_EDIT_STATUS
    );
}

export default {

    fieldList() {
        return fieldList();
    },

    operatorList() {
        return operatorList();
    },

    filterToText(filter) {
        let field = fieldList().find((el) => el.value == filter.field);
        let operator = operatorList().find((el) => el.value == filter.operator);
        let value = "\"" + filter.value + "\"";

        if (filter.value2) {
            value += ' и "' + filter.value2 + "\"";
        }

        return field.name + ' ' + operator.name.toLowerCase() + ' ' + value;
    }
}