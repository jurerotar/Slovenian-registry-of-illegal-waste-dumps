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
        /**
         * Used to show current page in navigation bar
         */
        currentPage: '',
        termsAndConditionsAgreements: {
            exportTermsAndConditions: false
        },
        /**
         * Used for determining what to show on interactive map
         * Possible values:
         *  total - sorts by total number of dumps
         *  clearedPercentage - sorts by total number of cleared
         *  uncleared - sorts by total number of uncleared
         *  dangerous - sorts by total number of dangerous dumps
         *  totalByArea
         *  unclearedByArea
         *  totalByPopulation
         *  unclearedByPopulation
         */
        interactiveMapSelected: 'total',
        /**
         * User coordinates
         */
        coordinates: {
            latitude: 46.717802958,
            longitude: 15.819759054
        },
        /**
         * This array of ids is used to determine which dump tables have additional information opened
         */
        dumpTables: {
            opened: [],
            sortBy: 'distance',
            showCleared: true,
            showDangerous: true,
        },

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
        },
        /**
         *
         * @param state
         * @param id
         */
        addOpenDumpTableId(state, id) {
            state.dumpTables.opened.push(id);
        },
        removeOpenDumpTableId(state, id) {
            state.dumpTables.opened = state.dumpTables.opened.filter(el => el !== id);
        },
        clearOpenDumpTableIds(state) {
            state.dumpTables.opened = [];
        }
    },
    getters: {},
    actions: {}
});

