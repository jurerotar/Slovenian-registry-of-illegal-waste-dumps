import {AppState} from "@/js/stores/modules/app-state.types";

const state = (): AppState => ({
  currentUrl: null,
  sidebarExtended: false,
  interactiveMapSelectedRegion: 'total',
  agreements: {
    dataExport: false,
  },
  userPreferences: {
    preferences: {
      darkThemeEnabled: false,
      accessibilityEnabled: false,
      reducedMotionEnabled: false,
      highContrastEnabled: false
    }
  },
});

const mutations = {
  setCurrentUrl(state: AppState, url: string) {
    state.currentUrl = url;
  },
  setSidebarExtended(state: AppState, mode: boolean) {
    state.sidebarExtended = mode;
  },
  setInteractiveMapSelectedRegion(state: AppState, regionSlug: string) {
    state.interactiveMapSelectedRegion = regionSlug;
  },
  setExportAgreement(state: AppState, mode: boolean) {
    state.agreements.dataExport = mode;
  }
}

const getters = {}

const actions = {}

export default {
  namespaced: true,
  state,
  mutations,
  getters,
  actions
}
