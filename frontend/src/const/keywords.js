export const KEYWORD_BROAD = { id: 1, name: 'BROAD', value: 'BROAD' };
export const KEYWORDS_PHRASE = { id: 2, name: 'PHRASE', value: 'PHRASE' };
export const KEYWORDS_EXACT = { id: 3, name: 'EXACT', value: 'EXACT' };

export const KEYWORDS_ALL = [KEYWORD_BROAD, KEYWORDS_EXACT, KEYWORDS_PHRASE];

export default {
    keywords() {
        return KEYWORDS_ALL;
    }
}