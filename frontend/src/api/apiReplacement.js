import apiService from "@/api/apiService";

export const GET_AD_BRANDS_PATH = '/api/replacements/{profileId}/ads/brands/get'
export const SET_AD_BRANDS_PATH = '/api/replacements/{profileId}/ads/brands/set'
export const GET_AD_REPLACES_PATH = '/api/replacements/{profileId}/ads/replaces/get'
export const SET_AD_REPLACES_PATH = '/api/replacements/{profileId}/ads/replaces/set'

export const GET_KEYWORD_BRANDS_PATH = '/api/replacements/{profileId}/keywords/brands/get'
export const SET_KEYWORD_BRANDS_PATH = '/api/replacements/{profileId}/keywords/brands/set'
export const GET_KEYWORD_REPLACES_PATH = '/api/replacements/{profileId}/keywords/replaces/get'
export const SET_KEYWORD_REPLACES_PATH = '/api/replacements/{profileId}/keywords/replaces/set'
export const GET_KEYWORD_COLORS_PATH = '/api/replacements/{profileId}/keywords/colors/get'
export const SET_KEYWORD_COLORS_PATH = '/api/replacements/{profileId}/keywords/colors/set'
export const GET_KEYWORD_KEYS_PATH = '/api/replacements/{profileId}/keywords/keys/get'
export const SET_KEYWORD_KEYS_PATH = '/api/replacements/{profileId}/keywords/keys/set'

export default {
    getReplacement(path, profileId) {
        return apiService.api.get(path.replace('{profileId}', profileId));
    },

    setReplacement(path, profileId, isUseGlobal, profileText) {
        return apiService.api.post(path.replace('{profileId}', profileId), { isUseGlobal: isUseGlobal, profileText: profileText });
    }
}