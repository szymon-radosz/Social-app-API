interface MainProps {}

interface MainState {
    userLoggedIn: boolean;
    showSidebarText: boolean;
    activeMenuSection: string;
    API_URL: string;
    showLoader: boolean;
    alertMessage: string;
    alertStatus: string;
}

export { MainProps, MainState };
