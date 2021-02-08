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
        selectedRegion: null,
        sidebarExtended: false,
        currentPage: '',
    },
    mutations: {
        setWidth(state, width) {
            state.width = width;
        },
        setHeight(state, height) {
            state.height = height;
        },
        setSelectedRegion(state, region) {
            state.selectedRegion = region;
        },
        setSidebarExtended(state, currentState) {
            state.sidebarExtended = currentState;
        },
        setCurrentPage(state, page) {
            state.currentPage = page;
        }
    },
    getters: {},
    actions: {}
});

