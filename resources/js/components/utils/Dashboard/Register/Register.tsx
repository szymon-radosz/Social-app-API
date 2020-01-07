import React, { Component } from "react";
import { RegisterProps, RegisterState } from "./Register.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";
import RegisterForm from "./RegisterForm/RegisterForm";
import axios from "axios";

class Register extends Component<RegisterProps, RegisterState> {
    constructor(props: RegisterProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Register");
    };

    addNewUser = (name, email, password) => {
        if (!name || !email || !password) {
            return this.context.handleShowAlert(
                "Cannot add new admin",
                "danger"
            );
        } else {
            this.context.handleShowLoader(true);
            return new Promise(async (resolve, reject) => {
                try {
                    let data = JSON.stringify({
                        name: name,
                        email: email,
                        password: password
                    });

                    axios
                        .post(`${this.context.API_URL}add-admin-user`, data, {
                            headers: {
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => {
                            this.context.handleShowAlert(
                                "Successfully added new admin",
                                "success"
                            );
                            resolve(response);
                        });
                } catch (err) {
                    console.log(err);
                    this.context.handleShowAlert(
                        "Cannot add new admin",
                        "danger"
                    );
                    reject(err);
                } finally {
                    this.context.handleShowLoader(false);
                }
            });
        }
    };

    render() {
        return (
            <DashboardContainer>
                <Header text="Register" />

                <RegisterForm addNewUser={this.addNewUser} />
            </DashboardContainer>
        );
    }
}
Register.contextType = MainContext;
export default Register;
