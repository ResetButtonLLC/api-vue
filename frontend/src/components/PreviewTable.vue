<template>
    <div class="container relative">
        <table>
            <thead>
                <tr>
                    <th v-for="column in columnList" :key="column" :element="column">{{ column.name }} <i
                            class="pi pi-eye-slash close" @click="$emit('hideColumn', column.value)"></i></th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(data, dataIndex) in dataList" :key="data + '---' + dataIndex">
                    <td class="unselectable"
                        :class="{ 'selected': dataIndex >= selectedFrom && dataIndex <= selectedTo }"
                        v-for="(element, elementIndex) in columnList" :key="dataIndex + 'x' + elementIndex"
                        @click.exact="selectFrom(elementIndex, dataIndex)"
                        @click.shift.exact="selectTo(elementIndex, dataIndex)"
                        @contextmenu.exact.prevent="contentMenu(elementIndex, dataIndex, false, $event)"
                        @contextmenu.shift.exact.prevent="contentMenu(elementIndex, dataIndex, true, $event)">

                        {{ drawValue(data[element.value], element.type) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-center" v-if="!columnList.length">
            Спрятаны все доступные поля. Нечего отображать.
        </div>

        <ul ref="contentMenu" id="right-click-menu" tabindex="-1"
            :style="{ top: contentTopPosition + 'px', left: contentLeftPosition + 'px' }" @blur="closeContentMenu">
            <li @click="showEditDialog" v-if="isColumnElementEditable">
                Редактировать
            </li>

            <li @click="closeContentMenu">
                Замена значений
            </li>

            <li @click="closeContentMenu">
                Закрыть меню
            </li>
        </ul>

        <EditFieldDialog v-if="isShowEditDialog" :initValue="selectedColumnElementValue"
            :type="selectedColumnElementType" @cancel="hideEditDialog" @save="changeFieldValue" />
    </div>
</template>

<script>
import EditFieldDialog from './EditFieldDialog';
import {
    TYPE_BOOLEAN,
    TYPE_STRING,
    TYPE_PIN,
    TYPE_KEY_TYPE,
} from "../const/filter";

import keywords from "../const/keywords";

export default {
    components: {
        EditFieldDialog
    },

    props: {
        dataList: Array,
        columnList: Array,
    },

    data() {
        return {
            isShowEditDialog: false,
            contentTopPosition: -9999,
            contentLeftPosition: -9999,
            selectedFrom: -1,
            selectedTo: -1,
            selectedColumn: -1
        };
    },

    methods: {
        drawBooleanValue(value) {
            return value ? 'Активно' : 'Не активно';
        },

        drawPinValue(value) {
            if (!value || value == '-') {
                return 'Не использовать';
            }

            return value;
        },

        drawKeyTypeValue(value) {
            if (!value || (Array.isArray(value) && !value.length)) {
                return 'Без ключевых слов';
            }

            return this.keywordTypes.filter((el) => (value.indexOf(el.id) !== -1)).map((el) => el.name).join(', ');
        },

        drawValue(value, type) {
            switch (type) {
                case TYPE_BOOLEAN:
                    return this.drawBooleanValue(value);
                case TYPE_PIN:
                    return this.drawPinValue(value);
                case TYPE_KEY_TYPE:
                    return this.drawKeyTypeValue(value);
                case TYPE_STRING:
                default:
                    return value;
            }
        },

        contentMenu(elementIndex, dataIndex, shift, $event) {
            if (dataIndex >= this.selectedFrom && dataIndex <= this.selectedTo) {
                this.selectedColumn = elementIndex;
                return this.showContentMenu($event);
            }

            if (shift) {
                this.selectTo(elementIndex, dataIndex);
            } else {
                this.selectFrom(elementIndex, dataIndex);
            }

            this.showContentMenu($event);
        },

        showContentMenu(event) {
            this.contentTopPosition = event.clientY;
            this.contentLeftPosition = event.clientX;
            this.$refs.contentMenu.focus();
        },

        closeContentMenu() {
            this.contentTopPosition = -9999;
            this.contentLeftPosition = -9999;
        },

        normalizeSelect() {
            if (this.selectedFrom > this.selectedTo) {
                let tmp = this.selectedFrom;
                this.selectedFrom = this.selectedTo;
                this.selectedTo = tmp;
            }
        },

        selectFrom(x, y) {
            this.selectedColumn = x;
            this.selectedFrom = y;
            this.selectedTo = y;
            this.normalizeSelect();
            console.log('start:' + x + ' ' + y);
        },

        selectTo(x, y) {
            if (this.selectedFrom == -1) {
                this.selectedFrom = y;
            }
            this.selectedColumn = x;
            this.selectedTo = y;
            this.normalizeSelect();
            console.log('end:' + x + ' ' + y);
        },

        showEditDialog() {
            this.isShowEditDialog = true;
            this.closeContentMenu();
        },

        hideEditDialog() {
            this.isShowEditDialog = false;
        },

        changeFieldValue(newValue) {
            this.$emit('changeValue', this.selectedFrom, this.selectedColumnElement.value, newValue);
            this.isShowEditDialog = false;
        }
    },

    computed: {
        selectedCount() {
            if (this.selectedTo == -1 || this.selectedFrom == -1) {
                return 0;
            }
            return this.selectedTo - this.selectedFrom + 1;
        },

        selectedColumnElement() {
            return this.columnList[this.selectedColumn];
        },

        selectedColumnElementValue() {
            if (!this.selectedColumnElement) {
                return null;
            }

            return this.dataList[this.selectedFrom][this.selectedColumnElement.value];
        },

        selectedColumnElementType() {
            if (!this.selectedColumnElement) {
                return null;
            }

            return this.selectedColumnElement.type;
        },

        isColumnElementEditable() {
            return (this.selectedColumnElement && this.selectedColumnElement.editable);
        },

        keywordTypes() {
            return keywords.keywords();
        },
    }
}
</script>

<style scoped>
.container {
    width: 100%;
    overflow-x: auto;
}

.unselectable {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

table,
th,
td {
    border: 1px solid #dee2e6;
    padding: 1rem 1rem;
    border-collapse: collapse;
}

th,
td {
    padding: 1rem 1rem;
    min-width: 50px;
}

table {
    width: 100%;
}

th {
    font-weight: 700;
    color: #343a40;
    background: #f8f9fa;
    white-space: nowrap !important;
}

td {
    background: #fff;
}

.selected {
    color: black;
    background-color: #005ec633;
    font-weight: 500;
    border-color: #3464ff4a;
}

.close {
    color: red;
    margin-left: 10px;
    cursor: pointer;
}

.disabled {
    color: #bdbdbd;
}
</style>