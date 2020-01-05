import React, { Component } from "react";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import { AppComponent } from "./../utils/styledComponents/AppComponent";
import { MainProps, MainState } from "./Main.interface";
import Dashboard from "./utils/Dashboard/Dashboard";
import Login from "./utils/Login/Login";
import { MainContext } from "./MainContext";
import history from "./History";
import Users from "./utils/Dashboard/Users/Users";
import ForumCategories from "./utils/Dashboard/ForumCategories/ForumCategories";
import ProductCategories from "./utils/Dashboard/ProductCategories/ProductCategories";
import Translations from "./utils/Dashboard/Translations/Translations";
import Register from "./utils/Dashboard/Register/Register";

class Main extends Component<MainProps, MainState> {
    history: any;
    routes: any;

    constructor(props: MainProps) {
        super(props);

        this.state = {
            userLoggedIn: false,
            showSidebarText: false,
            activeMenuSection: "",
            API_URL: "http://127.0.0.1:8000/api/",
            showLoader: false
        };

        this.history = history;

        this.routes = [
            {
                path: "/dashboard",
                name: "Dashboard",
                Component: Dashboard
            },
            {
                path: "/login",
                name: "Login",
                Component: Login
            },
            {
                path: "/users",
                name: "Users",
                Component: Users
            },
            {
                path: "/forum-categories",
                name: "ForumCategories",
                Component: ForumCategories
            },
            {
                path: "/product-categories",
                name: "ProductCategories",
                Component: ProductCategories
            },
            {
                path: "/translations",
                name: "Translations",
                Component: Translations
            },
            {
                path: "/register",
                name: "Register",
                Component: Register
            }
        ];
    }

    handleShowLoader = (status: boolean) => {
        console.log("handleShowLoader");
        this.setState({ showLoader: status });
    };

    handleShowSidebarText = () => {
        this.setState({ showSidebarText: !this.state.showSidebarText });
    };

    handlAactiveMenuSection = (text: string) => {
        this.setState({ activeMenuSection: text });
    };

    changePath = (path: string, state = {}) => {
        console.log(path);
        this.history.push({ pathname: path, state: state });
    };

    render() {
        const {
            userLoggedIn,
            showSidebarText,
            activeMenuSection,
            API_URL,
            showLoader
        } = this.state;

        return (
            <MainContext.Provider
                value={{
                    changePath: this.changePath,
                    userLoggedIn: userLoggedIn,
                    showSidebarText: showSidebarText,
                    handleShowSidebarText: this.handleShowSidebarText,
                    activeMenuSection: activeMenuSection,
                    handlAactiveMenuSection: this.handlAactiveMenuSection,
                    API_URL: API_URL,
                    showLoader: showLoader,
                    handleShowLoader: this.handleShowLoader
                }}
            >
                <div className="container-sm app__container">
                    <AppComponent>
                        <Router history={history}>
                            <Switch>
                                {this.routes.map(
                                    ({ path, name, Component }) => {
                                        return (
                                            <Route exact key={name} path={path}>
                                                <Component />
                                            </Route>
                                        );
                                    }
                                )}
                            </Switch>
                        </Router>
                    </AppComponent>
                </div>
            </MainContext.Provider>
        );
    }
}

export default Main;
