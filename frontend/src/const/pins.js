export const PIN_NONE = { name: 'Не использовать', value: '-' };
export const PIN1 = { name: 'Первый', value: '1' };
export const PIN2 = { name: 'Второй', value: '2' };
export const PIN3 = { name: 'Третий', value: '3' };

export const PIN_ALL = [PIN_NONE, PIN1, PIN2, PIN3];

export default {
    list() {
        return PIN_ALL;
    }
}