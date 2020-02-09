interface MainProps {}

interface MainState {
    userLoggedIn: boolean;
    showSidebarText: boolean;
    activeMenuSection: string;
    API_URL: string;
    APP_URL: string;
    showLoader: boolean;
    alertMessage: string;
    alertStatus: string;
    token: string;
}

export { MainProps, MainState };
