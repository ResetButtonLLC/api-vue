import apiService from "@/api/apiService";

const getMainSettingsPath = '/api/profile/{profileId}/section/main';
const setMainSettingsPath = '/api/profile/{profileId}/section/main';
const getImportSettingsPath = '/api/settings/import/{profileId}/get';
const setImportSettingsPath = '/api/settings/import/{profileId}/set';
const getGenerateAdsSettingsPath = '/api/settings/ads/{profileId}/get';
const setGenerateAdsSettingsPath = '/api/settings/ads/{profileId}/set';
const getGenerateKeywordsSettingsPath = '/api/settings/keywords/{profileId}/get';
const setGenerateKeywordsSettingsPath = '/api/settings/keywords/{profileId}/set';
const getAutoupdateSettingsPath = '/api/settings/autoupdate/{profileId}/get';
const setAutoupdateSettingsPath = '/api/settings/autoupdate/{profileId}/set';

export default {
    getMainSettings(profileId) {
        return apiService.api.get(getMainSettingsPath.replace('{profileId}', profileId));
    },

    setMainSettings(profileId, settings) {
        return apiService.api.patch(setMainSettingsPath.replace('{profileId}', profileId), settings);
    },

    getImportSettings(profileId) {
        return apiService.api.get(getImportSettingsPath.replace('{profileId}', profileId));
    },

    setImportSettings(profileId, settings) {
        return apiService.api.post(setImportSettingsPath.replace('{profileId}', profileId), { settings: settings });
    },

    getGenerateAdsSettings(profileId) {
        return apiService.api.get(getGenerateAdsSettingsPath.replace('{profileId}', profileId));
    },

    setGenerateAdsSettings(profileId, settings) {
        return apiService.api.post(setGenerateAdsSettingsPath.replace('{profileId}', profileId), { settings: settings });
    },

    getGenerateKeywordsSettings(profileId) {
        return apiService.api.get(getGenerateKeywordsSettingsPath.replace('{profileId}', profileId));
    },

    setGenerateKeywordsSettings(profileId, settings) {
        return apiService.api.post(setGenerateKeywordsSettingsPath.replace('{profileId}', profileId), { settings: settings });
    },

    getAutoupdateSettings(profileId) {
        return apiService.api.get(getAutoupdateSettingsPath.replace('{profileId}', profileId));
    },

    setAutoupdateSettings(profileId, settings) {
        return apiService.api.post(setAutoupdateSettingsPath.replace('{profileId}', profileId), { settings: settings });
    },
}
