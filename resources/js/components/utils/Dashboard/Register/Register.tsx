import React, { Component } from "react";
import { RegisterProps, RegisterState } from "./Register.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";

class Register extends Component<RegisterProps, RegisterState> {
    constructor(props: RegisterProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Register");
    };

    render() {
        return (
            <DashboardContainer>
                <Header text="Register" />
            </DashboardContainer>
        );
    }
}
Register.contextType = MainContext;
export default Register;
