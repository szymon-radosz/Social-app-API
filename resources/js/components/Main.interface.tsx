interface MainProps {}

interface MainState {
    userLoggedIn: boolean;
    showSidebarText: boolean;
    activeMenuSection: string;
    API_URL: string;
    showLoader: boolean;
}

export { MainProps, MainState };
