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
                    axios
                        .post(this.context.API_URL + "checkIfEmailExists", {
                            email: email
                        })
                        .then(async response => {
                            if (
                                response.data.status === "OK" &&
                                response.data.result === 1
                            ) {
                                //console.log(["checkIfEmailExists", response.data.result]);

                                this.context.handleShowAlert(
                                    "User with given email already exists",
                                    "danger"
                                );
                            } else {
                                axios
                                    .post(this.context.API_URL + "register", {
                                        name: name,
                                        email: email,
                                        password: password,
                                        admin_role: true
                                    })
                                    .then(response => {
                                        //console.log(response.data);
                                        if (response.data.status === "OK") {
                                            this.context.handleShowAlert(
                                                "Account created",
                                                "success"
                                            );
                                        } else {
                                            this.context.handleShowAlert(
                                                "Invalid Data",
                                                "danger"
                                            );
                                        }
                                    })
                                    .catch(error => {
                                        this.context.handleShowAlert(
                                            error,
                                            "danger"
                                        );
                                    });
                            }
                        });
                } catch (error) {
                    this.context.handleShowAlert(error, "danger");
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
