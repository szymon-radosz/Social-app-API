import React, { useContext } from "react";
import LoginForm from "./LoginForm/LoginForm";
import axios from "axios";
import { MainContext } from "./../../MainContext";

const Login = () => {
    const context = useContext(MainContext);

    const handleLoginSubmit = (email, password) => {
        if (email && !password) {
            context.handleShowAlert("Password required", "danger");
        } else if (!email && password) {
            context.handleShowAlert("Email required", "danger");
        } else if (!email && !password) {
            context.handleShowAlert("Email and password required", "danger");
        } else if (email && password) {
            try {
                let API_URL = context.API_URL;
                axios
                    .post(API_URL + "login", {
                        email: email,
                        password: password
                    })
                    .then(response => {
                        const { result } = response.data;
                        if (response.data.result.user_role === "admin") {
                            let token = response.data.result.token;

                            context.setToken(token);

                            localStorage.setItem("token", token);

                            const config = {
                                Authorization: `Bearer ${token}`,
                                "Content-Type":
                                    "application/x-www-form-urlencoded",
                                Accept: "application/json"
                            };

                            axios
                                .get(context.API_URL + "user", {
                                    headers: config
                                })
                                .then(response => {
                                    if (response.data.result.user.id) {
                                        context.setUserLoggedIn(true);
                                        context.handleChangePath("/dashboard");
                                    }
                                })
                                .catch(error => {
                                    context.handleShowAlert(error, "danger");
                                });
                        } else {
                            context.handleShowAlert(
                                response.data.result,
                                "danger"
                            );
                        }
                    })
                    .catch(error => {
                        context.handleShowAlert(error, "danger");
                    });
            } catch (error) {
                context.handleShowAlert("", "danger");
            }
        }
    };

    return (
        <div className="login-form__container">
            <LoginForm onLoginSubmit={handleLoginSubmit} />
        </div>
    );
};
export default Login;
