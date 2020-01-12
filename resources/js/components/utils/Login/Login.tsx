import React, { Component } from "react";
import { LoginProps, LoginState } from "./Login.interface";
import LoginForm from "./LoginForm/LoginForm";
import axios from "axios";
import { MainContext } from "./../../MainContext";

class Login extends Component<LoginProps, LoginState> {
    constructor(props: LoginProps) {
        super(props);

        this.state = {};
    }

    handleLoginSubmit = (email, password) => {
        console.log([email, password]);

        //console.log([email, password]);
        if (email && !password) {
            this.context.handleShowAlert("Password required", "danger");
        } else if (!email && password) {
            this.context.handleShowAlert("Email required", "danger");
        } else if (!email && !password) {
            this.context.handleShowAlert(
                "Email and password required",
                "danger"
            );
        } else if (email && password) {
            console.log(["API_URL", this.context.API_URL]);
            try {
                let API_URL = this.context.API_URL;
                //let navProps = navigation.state.params;
                //console.log([API_URL]);
                axios
                    .post(API_URL + "login", {
                        email: email,
                        password: password
                    })
                    .then(response => {
                        const { result } = response.data;
                        console.log(["data", result, response, response.data]);
                        if (response.data.result.user_role === "admin") {
                            //console.log(["response.data.user", response.data]);
                            let token = response.data.result.token;

                            const config = {
                                Authorization: `Bearer ${token}`,
                                "Content-Type":
                                    "application/x-www-form-urlencoded",
                                Accept: "application/json"
                            };

                            axios
                                .get(this.context.API_URL + "user", {
                                    headers: config
                                })
                                .then(response => {
                                    console.log([
                                        "userData",
                                        response.data.result
                                    ]);

                                    if (response.data.result.user.id) {
                                        this.context.setUserLoggedIn(true);
                                        this.context.changePath("/dashboard");
                                    }
                                })
                                .catch(error => {
                                    this.context.handleShowAlert(
                                        error,
                                        "danger"
                                    );
                                });
                        } else {
                            console.log("Nie ma tokena");
                            this.context.handleShowAlert(
                                response.data.result,
                                "danger"
                            );
                        }
                    })
                    .catch(error => {
                        this.context.handleShowAlert(error, "danger");
                    });
            } catch (error) {
                this.context.handleShowAlert("", "danger");
            }
        }
    };

    render() {
        return (
            <div className="login-form__container">
                <LoginForm onLoginSubmit={this.handleLoginSubmit} />
            </div>
        );
    }
}
Login.contextType = MainContext;
export default Login;
