import React, { Component } from "react";
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Redirect
} from "react-router-dom";
import { AppComponent } from "./../utils/styledComponents/AppComponent";
import { MainProps, MainState } from "./Main.interface";
import Dashboard from "./utils/Dashboard/Dashboard";
import Login from "./utils/Login/Login";
import { MainContext } from "./MainContext";
import history from "./History";
import Users from "./utils/Dashboard/Users/Users";
import ForumCategories from "./utils/Dashboard/ForumCategories/ForumCategories";
import Hobbies from "./utils/Dashboard/Hobbies/Hobbies";
import Translations from "./utils/Dashboard/Translations/Translations";
import Register from "./utils/Dashboard/Register/Register";
import Alert from "./utils/Alert/Alert";
import RegisterAdmin from "./utils/RegisterAdmin/RegisterAdmin"
import Home from "./utils/Home/Home"

class Main extends Component<MainProps, MainState> {
    history: any;
    routes: any;

    constructor(props: MainProps) {
        super(props);

        this.state = {
            userLoggedIn: false,
            showSidebarText: false,
            activeMenuSection: "",
            APP_URL: "http://127.0.0.1:8080",
            API_URL: "http://127.0.0.1:8080/api/",
            showLoader: false,
            alertMessage: "",
            alertStatus: "",
            token: ""
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
                path: "/register-dashboard",
                name: "RegisterAdmin",
                Component: RegisterAdmin
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
                path: "/hobbies",
                name: "Hobbies",
                Component: Hobbies
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
            },
            {
                path: "/",
                name: "Home",
                Component: Home
            }
        ];
    }

    setToken = token => {
        this.setState({ token });
    };

    setUserLoggedIn = status => {
        this.setState({ userLoggedIn: status });
    };

    handleLogout = () => {
        localStorage.clear();
        this.setState({ userLoggedIn: false });
    };

    handleShowAlert = (message: string, status: string) => {
        this.setState({ alertMessage: message, alertStatus: status });

        setTimeout(() => {
            this.setState({ alertMessage: "", alertStatus: "" });
        }, 4000);
    };

    handleShowLoader = (status: boolean) => {
        this.setState({ showLoader: status });
    };

    handleShowSidebarText = () => {
        this.setState({ showSidebarText: !this.state.showSidebarText });
    };

    handlAactiveMenuSection = (text: string) => {
        this.setState({ activeMenuSection: text });
    };

    handleChangePath = (path: string, state = {}) => {
        this.history.push({ pathname: path, state: state });
    };

    checkTokenExpiration = status => {
        if (status === 401) {
            this.handleShowAlert("Token invalid", "danger");
            this.handleLogout();
        }
    };

    componentDidMount = () => {
        if (localStorage.getItem("token")) {
            this.setState({
                token: localStorage.getItem("token"),
                userLoggedIn: true
            });
        }
    };

    getUrlLastSegment = () =>{
        return window.location.pathname.split("/").pop();
    }

    render() {
        const {
            userLoggedIn,
            showSidebarText,
            activeMenuSection,
            API_URL,
            APP_URL,
            showLoader,
            alertMessage,
            alertStatus,
            token
        } = this.state;

        const lastUrlSegment = this.getUrlLastSegment();

        return (
            <MainContext.Provider
                value={{
                    handleChangePath: this.handleChangePath,
                    userLoggedIn: userLoggedIn,
                    showSidebarText: showSidebarText,
                    handleShowSidebarText: this.handleShowSidebarText,
                    activeMenuSection: activeMenuSection,
                    handlAactiveMenuSection: this.handlAactiveMenuSection,
                    API_URL: API_URL,
                    APP_URL: APP_URL,
                    showLoader: showLoader,
                    handleShowLoader: this.handleShowLoader,
                    handleShowAlert: this.handleShowAlert,
                    setUserLoggedIn: this.setUserLoggedIn,
                    token: token,
                    setToken: this.setToken,
                    handleLogout: this.handleLogout,
                    checkTokenExpiration: this.checkTokenExpiration
                }}
            >
                {alertMessage && alertStatus && (
                    <Alert message={alertMessage} status={alertStatus} />
                )}
                <div className="container-sm app__container">
                    <AppComponent>
                        <Router history={history}>
                            {userLoggedIn && token ? (
                                <Redirect to="dashboard" />
                            ) : (lastUrlSegment === "login" ? 
                                <Redirect to="login" /> : 
                                lastUrlSegment === "register-dashboard" ? 
                                <Redirect to="register-dashboard" /> : 
                                <Redirect to="/" />
                            )}
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
