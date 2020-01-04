import React, { Component } from "react";
import { DashboardProps, DashboardState } from "./Dashboard.interface";
import ReactDOM from "react-dom";
import { Router, Switch, Route, Link, Redirect } from "react-router-dom";
import Users from "./Users/Users";
import { MainContext } from "./../../MainContext";
import TopBar from "../TopBar/TopBar";
import Sidebar from "../Sidebar/Sidebar";

class Dashboard extends Component<DashboardProps, DashboardState> {
    routes: any;

    constructor(props: DashboardProps) {
        super(props);

        this.state = {
            redirectLogin: true
        };

        this.routes = [
            {
                path: "/users",
                name: "Users",
                Component: Users
            }
        ];
    }

    componentDidMount = () => {
        if (this.context && !this.context.userLoggedIn) {
            console.log(this.context.userLoggedIn);
            this.setState({ redirectLogin: true });
        }
    };

    render() {
        const { redirectLogin } = this.state;

        if (!redirectLogin) {
            return <Redirect to="/login" />;
        } else {
            return <Redirect to="/users" />;
        }
    }
}

Dashboard.contextType = MainContext;
export default Dashboard;
