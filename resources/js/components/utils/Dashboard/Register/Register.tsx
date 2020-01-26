import React, { useContext, useEffect } from "react";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";
import RegisterForm from "./RegisterForm/RegisterForm";
import axios from "axios";

const Register = () => {
    const context = useContext(MainContext);

    const handleRegisterUser = (name, email, password) => {
        if (!name || !email || !password) {
            return context.handleShowAlert("Cannot add new admin", "danger");
        } else {
            context.handleShowLoader(true);
            return new Promise(async (resolve, reject) => {
                try {
                    axios
                        .post(
                            context.API_URL + "checkIfEmailExists",
                            {
                                email: email
                            },
                            {
                                headers: {
                                    Authorization: `Bearer ${context.token}`
                                }
                            }
                        )
                        .then(async response => {
                            if (
                                response.data.status === "OK" &&
                                response.data.result === 1
                            ) {
                                context.handleShowAlert(
                                    "User with given email already exists",
                                    "danger"
                                );
                            } else {
                                axios
                                    .post(context.API_URL + "register", {
                                        name: name,
                                        email: email,
                                        password: password,
                                        admin_role: true
                                    })
                                    .then(response => {
                                        if (response.data.token) {
                                            context.handleShowAlert(
                                                "Account created",
                                                "success"
                                            );
                                        } else {
                                            context.handleShowAlert(
                                                "Invalid Data",
                                                "danger"
                                            );
                                        }
                                    })
                                    .catch(error => {
                                        context.handleShowAlert(
                                            error,
                                            "danger"
                                        );

                                        context.checkTokenExpiration(
                                            error.response.status
                                        );
                                    });
                            }
                        })
                        .catch(err => {
                            context.checkTokenExpiration(err.response.status);
                        });
                } catch (error) {
                    context.handleShowAlert(error, "danger");
                } finally {
                    context.handleShowLoader(false);
                }
            });
        }
    };

    useEffect(() => {
        context.handlAactiveMenuSection("Register");
    }, []);

    return (
        <DashboardContainer>
            <Header text="Register" />

            <RegisterForm handleRegisterUser={handleRegisterUser} />
        </DashboardContainer>
    );
};
Register.contextType = MainContext;
export default Register;
