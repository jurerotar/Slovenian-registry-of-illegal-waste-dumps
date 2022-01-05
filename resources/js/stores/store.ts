import {createStore, Store} from 'vuex';
import appState from './modules/app-state';
import deviceProperties from './modules/device-properties';
import {AppState} from "@/js/stores/modules/app-state.types";
import {DeviceProperties} from "@/js/stores/modules/device-properties.types";

export interface State {
  appState: AppState,
  deviceProperties: DeviceProperties
}

export const store: Store<State> = createStore({
  modules: {
    deviceProperties,
    appState,
  }
});
