import {createStore} from 'vuex';


export default createStore({
    state: {
        breakpoints: {
            sm: 640,
            md: 768,
            lg: 1024,
            xl: 1280,
        },
        width: 0,
        height: 0,
        sidebarExtended: false,
        currentPage: '',
        termsAndConditionsAgreements: {
            exportTermsAndConditions: false
        },
        /**
         * Possible values:
         * total - sorts by total number of dumps
         * clearedPercentage - sorts by total number of cleared
         * uncleared - sorts by total number of uncleared
         * dangerous - sorts by total number of dangerous dumps
         * totalByArea
         * unclearedByArea
         * totalByPopulation
         * unclearedByPopulation
         */
        interactiveMapSelected: 'total',
        coordinates: {
            latitude: null,
            longitude: null
        }
    },
    mutations: {
        setWidth(state, width) {
            state.width = width;
        },
        setHeight(state, height) {
            state.height = height;
        },
        setSidebarExtended(state, currentState) {
            state.sidebarExtended = currentState;
        },
        setCurrentPage(state, page) {
            state.currentPage = page;
        },
        setTermsAndConditionsAgreements(state, name) {
            state.termsAndConditionsAgreements[name] = !state.termsAndConditionsAgreements[name];
        },
        setCoordinates(state, object) {
            state.coordinates = object;
        },
        setInteractiveMapSelected(state, key) {
            state.interactiveMapSelected = key;
        }
    },
    getters: {},
    actions: {}
});

