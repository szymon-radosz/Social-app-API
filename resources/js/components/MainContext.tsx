import React from "react";
export const MainContext = React.createContext({
    changePath: (path: string) => {},
    userLoggedIn: false,
    showSidebarText: false,
    handleShowSidebarText: () => {},
    activeMenuSection: "",
    handlAactiveMenuSection: (text: string) => {},
    API_URL: "",
    handleShowLoader: (status: boolean) => {},
    showLoader: false,
    handleShowAlert: (message: string, status: string) => {},
    setUserLoggedIn: (status: boolean) => {},
    token: "",
    setToken: (token: string) => {},
    handleLogout: () => {},
    checkTokenExpiration: (err: { status: string }) => {}
});
