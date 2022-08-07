export const AD_PUBLISHED = { name: 'Опубликовано', value: 'published' };
export const AD_NOT_PUBLISHED = { name: 'Не опубликовано', value: '!published' };
export const AD_CHANGED = { name: 'Изменено в локальной базе', value: 'changed' };
export const AD_ERROR = { name: 'Ошибка', value: 'error' };

export const AD_STATUS_ALL = [AD_PUBLISHED, AD_NOT_PUBLISHED, AD_CHANGED, AD_ERROR];

export default {
    list() {
        return AD_STATUS_ALL;
    }
}