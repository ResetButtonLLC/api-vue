const FILTER_TYPE_TEXT = 1;
const FILTER_TYPE_RANGE = 2;
const FILTER_TYPE_ATTR = 4;

const FILTER_LIST = [
    { caption: 'Содержит', value: 'CONTAINS', type: FILTER_TYPE_TEXT },
    { caption: 'Равно', value: 'EQUALS', type: FILTER_TYPE_TEXT },
    { caption: 'Равно атрибуту', value: 'EQUALS_ATTR', type: FILTER_TYPE_ATTR },
    { caption: 'Не равно', value: 'NOT_EQUALS', type: FILTER_TYPE_TEXT },
    { caption: 'Не равно атрибуту', value: 'NOT_EQUALS_ATTR', type: FILTER_TYPE_ATTR },
    { caption: 'Начинается с', value: 'BEGINS_WITH', type: FILTER_TYPE_TEXT },
    { caption: 'Заканчивается на', value: 'ENDS_WITH', type: FILTER_TYPE_TEXT },
    { caption: 'Не содержит', value: 'NOT_CONTAINS', type: FILTER_TYPE_TEXT },
    { caption: 'На начинается с', value: 'NOT_BEGINS_WITH', type: FILTER_TYPE_TEXT },
    { caption: 'Не заканчивается на', value: 'NOT_ENDS_WITH', type: FILTER_TYPE_TEXT },
    { caption: 'Больше чем', value: 'GREATER_THAN', type: FILTER_TYPE_TEXT },
    { caption: 'Больше чем атрибут', value: 'GREATER_THAN_ATTR', type: FILTER_TYPE_ATTR },
    { caption: 'Меньше чем', value: 'LESS_THAN', type: FILTER_TYPE_TEXT },
    { caption: 'Меньше чем атрибут', value: 'LESS_THAN_ATTR', type: FILTER_TYPE_ATTR },
    { caption: 'Больше или равно', value: 'GREATER_EQUAL', type: FILTER_TYPE_TEXT },
    { caption: 'Меньше или равно', value: 'LESS_EQUAL', type: FILTER_TYPE_TEXT },
    { caption: 'В диапазоне', value: 'BETWEEN', type: FILTER_TYPE_RANGE },
    { caption: 'Содержит регулярное выражение', value: 'EQUALS_REGEX', type: FILTER_TYPE_TEXT },
    { caption: 'Не содержит регулярное выражение', value: 'NOT_EQUALS_REGEX', type: FILTER_TYPE_TEXT },
];

export default {
    getFilterList() {
        return FILTER_LIST;
    },

    getFilterTextFromValue(value) {
        let result = '[unknown]';

        FILTER_LIST.forEach(el => {
            if (value == el.value) {
                result = el.caption;
            }
        });

        return result;
    },

    isFilterValueHave(value, type) {
        let result = false;

        FILTER_LIST.forEach(el => {
            if (value == el.value && el.type & type) {
                result = true;
            }
        });

        return result;
    },

    isFilterValueHaveTextType(filter) {
        return this.isFilterValueHave(filter, FILTER_TYPE_TEXT);
    },

    isFilterValueHaveRangeType(filter) {
        return this.isFilterValueHave(filter, FILTER_TYPE_RANGE);
    },

    isFilterValueHaveAttrType(filter) {
        return this.isFilterValueHave(filter, FILTER_TYPE_ATTR);
    },

    makeRule(ruleId, userId, targetField, filters) {
        return {
            id: ruleId,
            userId: userId,
            target: targetField,
            filters: filters,
        };
    },

    checkCondition(condition) {
        if (!condition.field) {
            return 1;
        }

        let filter = FILTER_LIST.find(el => {
            return el.value == condition.condition;
        });

        if (filter === undefined) {
            return 2;
        }

        return 0;
    },
}