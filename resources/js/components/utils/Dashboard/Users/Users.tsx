import React, { Component } from "react";
import { UsersProps, UsersState } from "./Users.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

class Users extends Component<UsersProps, UsersState> {
    constructor(props: UsersProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Users");
    };

    render() {
        return (
            <DashboardContainer>
                <div>Users</div>
            </DashboardContainer>
        );
    }
}

Users.contextType = MainContext;
export default Users;
