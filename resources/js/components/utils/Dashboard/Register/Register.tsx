import React, { Component } from "react";
import { RegisterProps, RegisterState } from "./Register.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

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
                <div>Register</div>
            </DashboardContainer>
        );
    }
}
Register.contextType = MainContext;
export default Register;
