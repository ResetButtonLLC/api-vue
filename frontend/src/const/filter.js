// TYPE
export const TYPE_UNDEFINED = 0;
export const TYPE_BOOLEAN = 1;
export const TYPE_STRING = 2;
export const TYPE_PIN = 3;
export const TYPE_KEY_TYPE = 4;
export const TYPE_STATUS = 5;

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
export const VALUE_LIST_CAMPAIGN = 512;
export const VALUE_LIST_GROUP = 1024;
export const VALUE_LIST_CATEGORIES = 2048;
export const VALUE_PIN = 4096;

/*
Фильтр отправляется на сервер в формате:
field:              XXXX
operator:           XXXX
serverOperator:     XXXX
value:              XXXX
value2:             XXXX

Серверные операторы (с скобках тип данных для value (value2 только для range)):
=           - равно (число, строка или дата)
!=          - не равно (число, строка или дата)
>           - меньше (число или дата)
>=          - меньше или равно (число или дата)
<           - больше (число или дата)
<=          - больше или равно (число или дата)
empty       - имеет пустое значение (ничего)
!empty      - имеет не пустое значение (ничего)
contain     - содержит (строка)
!contain    - не содержит (строка)
startwith   - начинается на (строка)
endwith     - заканчивается на (строка)
!startwith  - не начинается на (строка)
!endwith    - не заканчивается на (строка)
in          - в списке (массив)
!in         - не в списке (массив)
range       - в диапазоне от и до (числа и строковые даты)
any         - содержит любое из (массив)
!any        - не содержит любое из (массив)
all         - содержит всё из (массив)
!all        - не содержит всё из (массив)
*/

// OPERATORS
export const OPERATOR_STR_CONTAIN = {
    name: 'Содержит',
    value: 'contain',
    serverValue: 'CONTAINS',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: false
};
export const OPERATOR_STR_NOT_CONTAIN = {
    name: 'Не содержит',
    value: '!contain',
    serverValue: 'NOT_CONTAINS',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: false
};
export const OPERATOR_STR_EQUAL = {
    name: 'Равно',
    value: 's=',
    serverValue: 'EQUALS',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: true
};
export const OPERATOR_STR_NOT_EQUAL = {
    name: 'Не равно',
    value: 's!=',
    serverValue: 'NOT_EQUALS',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: true
};
export const OPERATOR_STR_START_WITH = {
    name: 'Начинается на',
    value: 'start_with',
    serverValue: 'BEGINS_WITH',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: false
};
export const OPERATOR_STR_END_WITH = {
    name: 'Заканчивается на',
    value: 'end_with',
    serverValue: 'ENDS_WITH',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: false
};
export const OPERATOR_STR_NOT_START_WITH = {
    name: 'Не начинается на',
    value: '!start_with',
    serverValue: 'NOT_BEGINS_WITH',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: false
};
export const OPERATOR_STR_NOT_END_WITH = {
    name: 'Не заканчивается на',
    value: '!end_with',
    serverValue: 'NOT_ENDS_WITH',
    type: [VALUE1_STR],
    default: ['', null],
    allowNull: false
};
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

export const OPERATOR_INT_EQUAL = {
    name: 'Равно',
    value: 'i=',
    serverValue: 'EQUALS',
    type: [VALUE1_INT],
    default: [0, null],
    allowNull: false
};
export const OPERATOR_INT_NOT_EQUAL = {
    name: 'Не равно',
    value: 'i!=',
    serverValue: 'NOT_EQUALS',
    type: [VALUE1_INT],
    default: [0, null],
    allowNull: false
};
export const OPERATOR_INT_GREATER_THAN = {
    name: 'Больше',
    value: 'i>',
    serverValue: 'GREATER_THAN',
    type: [VALUE1_INT],
    default: [0, null],
    allowNull: false
};
export const OPERATOR_INT_LOWER_THAN = {
    name: 'Меньше',
    value: 'i<',
    serverValue: 'LESS_THAN',
    type: [VALUE1_INT],
    default: [0, null],
    allowNull: false
};
export const OPERATOR_INT_GREATER_OR_EQUAL_THAN = {
    name: 'Больше или равно',
    value: 'i>=',
    serverValue: 'GREATER_EQUAL',
    type: [VALUE1_INT],
    default: [0, null],
    allowNull: false
};
export const OPERATOR_INT_LOWER_OR_EQUAL_THAN = {
    name: 'Меньше или равно',
    value: 'i<=',
    serverValue: 'LESS_EQUAL',
    type: [VALUE1_INT],
    default: [0, null],
    allowNull: false
};
export const OPERATOR_INT_IN_RANGE = {
    name: 'В диапазоне',
    value: 'i-range',
    serverValue: 'BETWEEN',
    type: [VALUE1_INT, VALUE2_INT],
    default: [0, 0],
    allowNull: false
};
export const OPERATORS_INTEGER = [
    OPERATOR_INT_EQUAL,
    OPERATOR_INT_NOT_EQUAL,
    OPERATOR_INT_GREATER_THAN,
    OPERATOR_INT_LOWER_THAN,
    OPERATOR_INT_GREATER_OR_EQUAL_THAN,
    OPERATOR_INT_LOWER_OR_EQUAL_THAN,
    OPERATOR_INT_IN_RANGE
];

// Boolean
export const OPERATOR_BOOLEAN_EQUAL = {
    name: 'Включено',
    value: 'b=',
    serverValue: 'EQUALS',
    type: [VALUE_BOOLEAN],
    default: [true, null],
    allowNull: true
};

export const OPERATOR_BOOLEAN_NOT_EQUAL = {
    name: 'Не включено',
    value: 'b!=',
    serverValue: 'EQUALS',
    type: [VALUE_BOOLEAN],
    default: [false, null],
    allowNull: true
};
export const OPERATORS_BOOLEAN = [
    OPERATOR_BOOLEAN_EQUAL,
    OPERATOR_BOOLEAN_NOT_EQUAL
];

// Ad edit status
export const OPERATOR_AD_EDIT_STATUS_EQUAL = {
    name: 'Равно',
    value: 'aes=',
    serverValue: 'EQUALS',
    type: [VALUE_AD_EDIT_STATUS],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_AD_EDIT_STATUS_NOT_EQUAL = {
    name: 'Не равно',
    value: 'aes!=',
    serverValue: 'NOT_EQUALS',
    type: [VALUE_AD_EDIT_STATUS],
    default: [null, null],
    allowNull: false
};
export const OPERATORS_AD_EDIT_STATUS = [
    OPERATOR_AD_EDIT_STATUS_EQUAL,
    OPERATOR_AD_EDIT_STATUS_NOT_EQUAL
];

// Key type
export const OPERATOR_KEY_TYPE_EQUAL = {
    name: 'Равно',
    value: 'kt=',
    serverValue: 'EQUALS',
    type: [VALUE_KEY_TYPE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_KEY_TYPE_NOT_EQUAL = {
    name: 'Не равно',
    value: 'kt!=',
    serverValue: 'NOT_EQUALS',
    type: [VALUE_KEY_TYPE],
    default: [null, null],
    allowNull: false
};
export const OPERATORS_KEY_TYPE = [
    OPERATOR_KEY_TYPE_EQUAL,
    OPERATOR_KEY_TYPE_NOT_EQUAL
];

// Date
export const OPERATOR_DATE_EQUAL = {
    name: 'Равно',
    value: 'd=',
    serverValue: 'EQUALS',
    type: [VALUE1_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_DATE_NOT_EQUAL = {
    name: 'Не равно',
    value: 'd!=',
    serverValue: 'NOT_EQUALS',
    type: [VALUE1_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_DATE_GREATER_THAN = {
    name: 'После',
    value: 'd>',
    serverValue: 'GREATER_THAN',
    type: [VALUE1_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_DATE_LOWER_THAN = {
    name: 'До',
    value: 'd<',
    serverValue: 'LESS_THAN',
    type: [VALUE1_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_DATE_GREATER_OR_EQUAL_THAN = {
    name: 'После (включительно)',
    value: 'd>=',
    serverValue: 'GREATER_EQUAL',
    type: [VALUE1_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_DATE_LOWER_OR_EQUAL_THAN = {
    name: 'До (включительно)',
    value: 'd<=',
    serverValue: 'LESS_EQUAL',
    type: [VALUE1_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_DATE_IN_RANGE = {
    name: 'В диапазоне',
    value: 'd-range',
    serverValue: 'BETWEEN',
    type: [VALUE1_DATE, VALUE2_DATE],
    default: [null, null],
    allowNull: false
};
export const OPERATORS_DATE = [
    OPERATOR_DATE_EQUAL,
    OPERATOR_DATE_NOT_EQUAL,
    OPERATOR_DATE_GREATER_THAN,
    OPERATOR_DATE_LOWER_THAN,
    OPERATOR_DATE_GREATER_OR_EQUAL_THAN,
    OPERATOR_DATE_LOWER_OR_EQUAL_THAN,
    OPERATOR_DATE_IN_RANGE
];

// Campaign
export const OPERATOR_CAMPAIGN_LIST_CONTAIN_ANY = {
    name: 'Содержит любое из',
    value: 'campaign_contain_any',
    serverValue: 'EQUALS',
    type: [VALUE_LIST_CAMPAIGN],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_CAMPAIGN_LIST_NOT_CONTAIN_ANY = {
    name: 'Не содержит любое из',
    value: '!campaign_contain_any',
    serverValue: 'NOT_EQUALS',
    type: [VALUE_LIST_CAMPAIGN],
    default: [null, null],
    allowNull: false
};
/*
export const OPERATOR_CAMPAIGN_LIST_CONTAIN_ALL = {
    name: 'Содержит все из',
    value: 'campaign_contain_all',
    serverValue: 'all',
    type: [VALUE_LIST_CAMPAIGN],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_CAMPAIGN_LIST_NOT_CONTAIN_ALL = {
    name: 'Не содержит все из',
    value: '!campaign_contain_all',
    serverValue: '!all',
    type: [VALUE_LIST_CAMPAIGN],
    default: [null, null],
    allowNull: false
};
*/
export const OPERATOR_CAMPAIGN_LIST_EMPTY = {
    name: 'Не содержит ничего',
    value: 'campaign_empty',
    serverValue: 'empty',
    type: [VALUE_BOOLEAN],
    default: [true, null],
    allowNull: true
};
export const OPERATOR_CAMPAIGN_LIST_NOT_EMPTY = {
    name: 'Содержит что-то',
    value: '!campaign_empty',
    serverValue: '!empty',
    type: [VALUE_BOOLEAN],
    default: [false, null],
    allowNull: true
};
export const OPERATORS_CAMPAIGN_LIST = [
    OPERATOR_CAMPAIGN_LIST_CONTAIN_ANY,
    OPERATOR_CAMPAIGN_LIST_NOT_CONTAIN_ANY,
    //OPERATOR_CAMPAIGN_LIST_CONTAIN_ALL,
    //OPERATOR_CAMPAIGN_LIST_NOT_CONTAIN_ALL,
    OPERATOR_CAMPAIGN_LIST_EMPTY,
    OPERATOR_CAMPAIGN_LIST_NOT_EMPTY
];

// Category
export const OPERATOR_CATEGORY_LIST_CONTAIN_ANY = {
    name: 'Содержит любое из',
    value: 'category_contain_any',
    serverValue: 'EQUALS',
    type: [VALUE_LIST_CATEGORIES],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_CATEGORY_LIST_NOT_CONTAIN_ANY = {
    name: 'Не содержит любое из',
    value: '!category_contain_any',
    serverValue: 'NOT_EQUALS',
    type: [VALUE_LIST_CATEGORIES],
    default: [null, null],
    allowNull: false
};
/*
export const OPERATOR_CATEGORY_LIST_CONTAIN_ALL = {
    name: 'Содержит все из',
    value: 'category_contain_all',
    serverValue: 'all',
    type: [VALUE_LIST_CATEGORIES],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_CATEGORY_LIST_NOT_CONTAIN_ALL = {
    name: 'Не содержит все из',
    value: '!category_contain_all',
    serverValue: '!all',
    type: [VALUE_LIST_CATEGORIES],
    default: [null, null],
    allowNull: false
};
*/
export const OPERATOR_CATEGORY_LIST_EMPTY = {
    name: 'Не содержит ничего',
    value: 'category_empty',
    serverValue: 'empty',
    type: [VALUE_BOOLEAN],
    default: [true, null],
    allowNull: true
};
export const OPERATOR_CATEGORY_LIST_NOT_EMPTY = {
    name: 'Содержит что-то',
    value: '!category_empty',
    serverValue: '!empty',
    type: [VALUE_BOOLEAN],
    default: [false, null],
    allowNull: true
};
export const OPERATORS_CATEGORY_LIST = [
    OPERATOR_CATEGORY_LIST_CONTAIN_ANY,
    OPERATOR_CATEGORY_LIST_NOT_CONTAIN_ANY,
    //OPERATOR_CATEGORY_LIST_CONTAIN_ALL,
    //OPERATOR_CATEGORY_LIST_NOT_CONTAIN_ALL,
    OPERATOR_CATEGORY_LIST_EMPTY,
    OPERATOR_CATEGORY_LIST_NOT_EMPTY
];

// Group
export const OPERATOR_GROUP_LIST_CONTAIN_ANY = {
    name: 'Содержит любое из',
    value: 'group_contain_any',
    serverValue: 'EQUALS',
    type: [VALUE_LIST_GROUP],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_GROUP_LIST_NOT_CONTAIN_ANY = {
    name: 'Не содержит любое из',
    value: '!group_contain_any',
    serverValue: 'NOT_EQUALS',
    type: [VALUE_LIST_GROUP],
    default: [null, null],
    allowNull: false
};
/*
export const OPERATOR_GROUP_LIST_CONTAIN_ALL = {
    name: 'Содержит все из',
    value: 'group_contain_all',
    serverValue: 'all',
    type: [VALUE_LIST_GROUP],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_GROUP_LIST_NOT_CONTAIN_ALL = {
    name: 'Не содержит все из',
    value: '!group_contain_all',
    serverValue: '!all',
    type: [VALUE_LIST_GROUP],
    default: [null, null],
    allowNull: false
};
*/
export const OPERATOR_GROUP_LIST_EMPTY = {
    name: 'Не содержит ничего',
    value: 'group_empty',
    serverValue: 'empty',
    type: [VALUE_BOOLEAN],
    default: [true, null],
    allowNull: true
};
export const OPERATOR_GROUP_LIST_NOT_EMPTY = {
    name: 'Содержит что-то',
    value: '!group_empty',
    serverValue: '!empty',
    type: [VALUE_BOOLEAN],
    default: [false, null],
    allowNull: true
};
export const OPERATORS_GROUP_LIST = [
    OPERATOR_GROUP_LIST_CONTAIN_ANY,
    OPERATOR_GROUP_LIST_NOT_CONTAIN_ANY,
    //OPERATOR_GROUP_LIST_CONTAIN_ALL,
    //OPERATOR_GROUP_LIST_NOT_CONTAIN_ALL,
    OPERATOR_GROUP_LIST_EMPTY,
    OPERATOR_GROUP_LIST_NOT_EMPTY
];

// Pin
export const OPERATOR_PIN_EQUAL = {
    name: 'Равно',
    value: 'kt=',
    serverValue: 'EQUALS',
    type: [VALUE_PIN],
    default: [null, null],
    allowNull: false
};
export const OPERATOR_PIN_NOT_EQUAL = {
    name: 'Не равно',
    value: 'kt!=',
    serverValue: 'NOT_EQUALS',
    type: [VALUE_PIN],
    default: [null, null],
    allowNull: false
};
export const OPERATORS_PIN = [
    OPERATOR_PIN_EQUAL,
    OPERATOR_PIN_NOT_EQUAL
];

// FIELDS
export const FIELD_HEADLINE1 = {
    name: 'Заголовок 1',
    alias: "headline 1",
    value: 'headline1',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE2 = {
    name: 'Заголовок 2',
    alias: "headline 2",
    value: 'headline2',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE3 = {
    name: 'Заголовок 3',
    alias: "headline 3",
    value: 'headline3',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE4 = {
    name: 'Заголовок 4',
    alias: "headline 4",
    value: 'headline4',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE5 = {
    name: 'Заголовок 5',
    alias: "headline 5",
    value: 'headline5',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE6 = {
    name: 'Заголовок 6',
    alias: "headline 6",
    value: 'headline6',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE7 = {
    name: 'Заголовок 7',
    alias: "headline 7",
    value: 'headline7',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE8 = {
    name: 'Заголовок 8',
    alias: "headline 8",
    value: 'headline8',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE9 = {
    name: 'Заголовок 9',
    alias: "headline 9",
    value: 'headline9',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE10 = {
    name: 'Заголовок 10',
    alias: "headline 10",
    value: 'headline10',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE11 = {
    name: 'Заголовок 11',
    alias: "headline 11",
    value: 'headline11',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE12 = {
    name: 'Заголовок 12',
    alias: "headline 12",
    value: 'headline12',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE13 = {
    name: 'Заголовок 13',
    alias: "headline 13",
    value: 'headline13',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE14 = {
    name: 'Заголовок 14',
    alias: "headline 14",
    value: 'headline14',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE15 = {
    name: 'Заголовок 15',
    alias: "headline 15",
    value: 'headline15',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_DESCRIPTION1 = {
    name: 'Описание 1',
    alias: "description 1",
    value: 'description1',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_DESCRIPTION2 = {
    name: 'Описание 2',
    alias: "description 2",
    value: 'description2',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_DESCRIPTION3 = {
    name: 'Описание 3',
    alias: "description 3",
    value: 'description3',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_DESCRIPTION4 = {
    name: 'Описание 4',
    alias: "description 4",
    value: 'description4',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_HEADLINE1_PIN = {
    name: 'Позиция заголовка 1',
    alias: "headline position pin 1",
    value: 'headline1_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE2_PIN = {
    name: 'Позиция заголовка 2',
    alias: "headline position pin 2",
    value: 'headline2_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE3_PIN = {
    name: 'Позиция заголовка 3',
    alias: "headline position pin 3",
    value: 'headline3_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE4_PIN = {
    name: 'Позиция заголовка 4',
    alias: "headline position pin 4",
    value: 'headline4_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE5_PIN = {
    name: 'Позиция заголовка 5',
    alias: "headline position pin 5",
    value: 'headline5_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE6_PIN = {
    name: 'Позиция заголовка 6',
    alias: "headline position pin 6",
    value: 'headline6_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE7_PIN = {
    name: 'Позиция заголовка 7',
    alias: "headline position pin 7",
    value: 'headline7_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE8_PIN = {
    name: 'Позиция заголовка 8',
    alias: "headline position pin 8",
    value: 'headline8_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE9_PIN = {
    name: 'Позиция заголовка 9',
    alias: "headline position pin 9",
    value: 'headline9_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE10_PIN = {
    name: 'Позиция заголовка 10',
    alias: "headline position pin 10",
    value: 'headline10_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE11_PIN = {
    name: 'Позиция заголовка 11',
    alias: "headline position pin 11",
    value: 'headline11_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE12_PIN = {
    name: 'Позиция заголовка 12',
    alias: "headline position pin 12",
    value: 'headline12_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE13_PIN = {
    name: 'Позиция заголовка 13',
    alias: "headline position pin 13",
    value: 'headline13_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE14_PIN = {
    name: 'Позиция заголовка 14',
    alias: "headline position pin 14",
    value: 'headline14_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_HEADLINE15_PIN = {
    name: 'Позиция заголовка 15',
    alias: "headline position pin 15",
    value: 'headline15_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_DESCRIPTION1_PIN = {
    name: 'Позиция описания 1',
    alias: "description 1",
    value: 'description1_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_DESCRIPTION2_PIN = {
    name: 'Позиция описания 2',
    alias: "description 2",
    value: 'description2_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_DESCRIPTION3_PIN = {
    name: 'Позиция описания 3',
    alias: "description 3",
    value: 'description3_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_DESCRIPTION4_PIN = {
    name: 'Позиция описания 4',
    alias: "description 4",
    value: 'description4_pin',
    operators: OPERATORS_PIN,
    editable: true,
    type: TYPE_PIN
};

export const FIELD_PATH1 = {
    name: 'Путь1',
    alias: "path1",
    value: 'path1',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_PATH2 = {
    name: 'Путь2',
    alias: "path2",
    value: 'path2',
    operators: OPERATORS_STRING,
    editable: true,
    type: TYPE_STRING
};

export const FIELD_URL = {
    name: 'URL',
    alias: "адрес сайта",
    value: 'url',
    operators: OPERATORS_STRING,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_PRICE = {
    name: 'Цена',
    alias: "price",
    value: 'price',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_ID = {
    name: 'ID',
    alias: "айди",
    value: 'id',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_GOOGLE_ID = {
    name: 'Google ID',
    alias: "гугл айди",
    value: 'googleid',
    operators: OPERATORS_STRING,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_STATUS = {
    name: 'Статус',
    alias: "status",
    value: 'status',
    operators: OPERATORS_BOOLEAN,
    editable: false,
    type: TYPE_BOOLEAN
};

export const FIELD_AD_EDIT_STATUS = {
    name: 'Статус редактирования',
    alias: "ad edit status",
    value: 'editstatus',
    operators: OPERATORS_AD_EDIT_STATUS,
    editable: false,
    type: TYPE_STATUS
};

export const FIELD_CATEGORY = {
    name: 'Категория',
    alias: "category",
    value: 'category',
    operators: OPERATORS_CATEGORY_LIST,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_AD_COUNT = {
    name: 'Количество объявлений',
    alias: "ad count",
    value: 'adcount',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_AD_COUNT_ACTIVE = {
    name: 'Количество активных объявлений',
    alias: "ad count active",
    value: 'adcount-active',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_AD_COUNT_PAUSED = {
    name: 'Количество объявлений в паузе',
    alias: "ad count paused",
    value: 'adcount-paused',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_GROUP = {
    name: 'Группа',
    alias: "group",
    value: 'group',
    operators: OPERATORS_GROUP_LIST,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_GROUP_ID = {
    name: 'ID группы',
    alias: "айди группы",
    value: 'groupid',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_GROUP_GOOGLE_ID = {
    name: 'ID группы в Google',
    alias: "гугл айди группы",
    value: 'groupgoogleid',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_CAMPAIGN = {
    name: 'Кампания',
    alias: "campaign",
    value: 'campaign',
    operators: OPERATORS_CAMPAIGN_LIST,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_CAMPAIGN_ID = {
    name: 'ID кампании',
    alias: "айди кампании",
    value: 'campaignid',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_CAMPAIGN_GOOGLE_ID = {
    name: 'ID кампании в Google',
    alias: "айди кампании в гугл",
    value: 'campaigngoogleid',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_KEY_TYPE = {
    name: 'Тип ключа',
    alias: "key type",
    value: 'keytype',
    operators: OPERATORS_KEY_TYPE,
    editable: true,
    type: TYPE_KEY_TYPE
};

export const FIELD_KEYWORD = {
    name: 'Ключевое слово',
    alias: "keyword",
    value: 'keyword',
    operators: OPERATORS_STRING,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_PARAM1 = {
    name: 'param1',
    alias: "param1",
    value: 'param1',
    operators: OPERATORS_INTEGER,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_CREATION_DATE = {
    name: 'Дата создания',
    alias: "created at",
    value: 'created_at',
    operators: OPERATORS_DATE,
    editable: false,
    type: TYPE_UNDEFINED
};

export const FIELD_UPDATE_DATE = {
    name: 'Дата обновления',
    alias: "updated at",
    value: 'updated_at',
    operators: OPERATORS_DATE,
    editable: false,
    type: TYPE_UNDEFINED
};

function fieldList() {
    return [
        FIELD_ID,
        FIELD_GOOGLE_ID,
        FIELD_STATUS,
        FIELD_AD_EDIT_STATUS,
        FIELD_CATEGORY,
        FIELD_CAMPAIGN,
        FIELD_CAMPAIGN_ID,
        FIELD_CAMPAIGN_GOOGLE_ID,
        FIELD_GROUP,
        FIELD_GROUP_ID,
        FIELD_GROUP_GOOGLE_ID,
        FIELD_PRICE,
        FIELD_HEADLINE1,
        FIELD_HEADLINE2,
        FIELD_HEADLINE3,
        FIELD_HEADLINE4,
        FIELD_HEADLINE5,
        FIELD_HEADLINE6,
        FIELD_HEADLINE7,
        FIELD_HEADLINE8,
        FIELD_HEADLINE9,
        FIELD_HEADLINE10,
        FIELD_HEADLINE11,
        FIELD_HEADLINE12,
        FIELD_HEADLINE13,
        FIELD_HEADLINE14,
        FIELD_HEADLINE15,
        FIELD_DESCRIPTION1,
        FIELD_DESCRIPTION2,
        FIELD_DESCRIPTION3,
        FIELD_DESCRIPTION4,
        FIELD_HEADLINE1_PIN,
        FIELD_HEADLINE2_PIN,
        FIELD_HEADLINE3_PIN,
        FIELD_HEADLINE4_PIN,
        FIELD_HEADLINE5_PIN,
        FIELD_HEADLINE6_PIN,
        FIELD_HEADLINE7_PIN,
        FIELD_HEADLINE8_PIN,
        FIELD_HEADLINE9_PIN,
        FIELD_HEADLINE10_PIN,
        FIELD_HEADLINE11_PIN,
        FIELD_HEADLINE12_PIN,
        FIELD_HEADLINE13_PIN,
        FIELD_HEADLINE14_PIN,
        FIELD_HEADLINE15_PIN,
        FIELD_DESCRIPTION1_PIN,
        FIELD_DESCRIPTION2_PIN,
        FIELD_DESCRIPTION3_PIN,
        FIELD_DESCRIPTION4_PIN,
        FIELD_PATH1,
        FIELD_PATH2,
        FIELD_URL,
        FIELD_KEY_TYPE,
        FIELD_KEYWORD,
        FIELD_PARAM1,
        FIELD_AD_COUNT,
        FIELD_AD_COUNT_ACTIVE,
        FIELD_AD_COUNT_PAUSED,
        FIELD_CREATION_DATE,
        FIELD_UPDATE_DATE
    ];
}

function fieldListForGroups() {
    return [
        FIELD_ID,
        FIELD_GOOGLE_ID,
        FIELD_STATUS,
        FIELD_AD_EDIT_STATUS,
        FIELD_AD_COUNT,
        FIELD_AD_COUNT_ACTIVE,
        FIELD_AD_COUNT_PAUSED,
        FIELD_CAMPAIGN,
        FIELD_CAMPAIGN_ID,
        FIELD_CAMPAIGN_GOOGLE_ID,
        FIELD_CREATION_DATE,
        FIELD_UPDATE_DATE
    ];
}

function fieldListForAds() {
    return [
        FIELD_ID,
        FIELD_GOOGLE_ID,
        FIELD_STATUS,
        FIELD_AD_EDIT_STATUS,
        FIELD_CATEGORY,
        FIELD_GROUP,
        FIELD_GROUP_ID,
        FIELD_GROUP_GOOGLE_ID,
        FIELD_CAMPAIGN,
        FIELD_CAMPAIGN_ID,
        FIELD_CAMPAIGN_GOOGLE_ID,
        FIELD_PRICE,
        FIELD_URL,
        FIELD_HEADLINE1,
        FIELD_HEADLINE2,
        FIELD_HEADLINE3,
        FIELD_HEADLINE4,
        FIELD_HEADLINE5,
        FIELD_HEADLINE6,
        FIELD_HEADLINE7,
        FIELD_HEADLINE8,
        FIELD_HEADLINE9,
        FIELD_HEADLINE10,
        FIELD_HEADLINE11,
        FIELD_HEADLINE12,
        FIELD_HEADLINE13,
        FIELD_HEADLINE14,
        FIELD_HEADLINE15,
        FIELD_DESCRIPTION1,
        FIELD_DESCRIPTION2,
        FIELD_DESCRIPTION3,
        FIELD_DESCRIPTION4,
        FIELD_HEADLINE1_PIN,
        FIELD_HEADLINE2_PIN,
        FIELD_HEADLINE3_PIN,
        FIELD_HEADLINE4_PIN,
        FIELD_HEADLINE5_PIN,
        FIELD_HEADLINE6_PIN,
        FIELD_HEADLINE7_PIN,
        FIELD_HEADLINE8_PIN,
        FIELD_HEADLINE9_PIN,
        FIELD_HEADLINE10_PIN,
        FIELD_HEADLINE11_PIN,
        FIELD_HEADLINE12_PIN,
        FIELD_HEADLINE13_PIN,
        FIELD_HEADLINE14_PIN,
        FIELD_HEADLINE15_PIN,
        FIELD_DESCRIPTION1_PIN,
        FIELD_DESCRIPTION2_PIN,
        FIELD_DESCRIPTION3_PIN,
        FIELD_DESCRIPTION4_PIN,
        FIELD_PATH1,
        FIELD_PATH2,
        FIELD_CREATION_DATE,
        FIELD_UPDATE_DATE
    ];
}

function fieldListForKeywords() {
    return [
        FIELD_ID,
        FIELD_GOOGLE_ID,
        FIELD_STATUS,
        FIELD_AD_EDIT_STATUS,
        FIELD_KEYWORD,
        FIELD_PARAM1,
        FIELD_KEY_TYPE,
        FIELD_GROUP,
        FIELD_GROUP_ID,
        FIELD_GROUP_GOOGLE_ID,
        FIELD_CAMPAIGN,
        FIELD_CAMPAIGN_ID,
        FIELD_CAMPAIGN_GOOGLE_ID,
        FIELD_CREATION_DATE,
        FIELD_UPDATE_DATE
    ];
}

export default {

    fieldList() {
        return fieldList();
    },

    fieldListForGroups() {
        return fieldListForGroups();
    },

    fieldListForAds() {
        return fieldListForAds();
    },

    fieldListForKeywords() {
        return fieldListForKeywords();
    },

    filterToText(filter) {
        let field = fieldList().find((el) => el.value == filter.field);
        let operator = field.operators.find((el) => el.value == filter.operator);

        // TEXT FOR BOOLEANS
        if (filter.value === false || filter.value === true) {
            return field.name + ' "' + operator.name.toLowerCase() + '"';
        }

        let value;

        if (filter.textValue) {
            value = "\"" + filter.textValue + "\"";
        } else {
            value = "\"" + filter.value + "\"";

            if (filter.value2) {
                value += ' и "' + filter.value2 + "\"";
            }
        }

        return field.name + ' ' + operator.name.toLowerCase() + ' ' + value;
    }
}