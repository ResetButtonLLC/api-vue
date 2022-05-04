export const KEYWORD_BROAD = { name: 'BROAD', value: 'BROAD' };
export const KEYWORDS_EXACT = { name: 'EXACT', value: 'EXACT' };
export const KEYWORDS_PHRASE = { name: 'PHARESE', value: 'PHARESE' };

export const KEYWORDS_ALL = [KEYWORD_BROAD, KEYWORDS_EXACT, KEYWORDS_PHRASE];

export default {
    keywords() {
        return KEYWORDS_ALL;
    }
}