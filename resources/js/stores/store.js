import { createStore } from 'vuex';
import appState from './modules/app-state';
import deviceProperties from './modules/device-properties';
export const store = createStore({
    modules: {
        deviceProperties,
        appState,
    }
});
