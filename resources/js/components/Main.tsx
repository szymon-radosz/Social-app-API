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
import Information from "./utils/Dashboard/Information/Information";
import Customize from "./utils/Dashboard/Customize/Customize";
import Slides from "./utils/Dashboard/Slides/Slides";
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
            activeMenuSection: ""
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
                path: "/information",
                name: "Information",
                Component: Information
            },
            {
                path: "/customize",
                name: "Customize",
                Component: Customize
            },
            {
                path: "/slides",
                name: "Slides",
                Component: Slides
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

    handleShowSidebarText = () => {
        this.setState({ showSidebarText: !this.state.showSidebarText });
    };

    handlAactiveMenuSection = text => {
        this.setState({ activeMenuSection: text });
    };

    changePath = (path: string, state = {}) => {
        console.log(path);
        this.history.push({ pathname: path, state: state });
    };

    render() {
        const { userLoggedIn, showSidebarText, activeMenuSection } = this.state;

        return (
            <MainContext.Provider
                value={{
                    changePath: this.changePath,
                    userLoggedIn: userLoggedIn,
                    showSidebarText: showSidebarText,
                    handleShowSidebarText: this.handleShowSidebarText,
                    activeMenuSection: activeMenuSection,
                    handlAactiveMenuSection: this.handlAactiveMenuSection
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
