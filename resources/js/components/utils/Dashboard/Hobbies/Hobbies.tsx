import React, { Component } from "react";
import { HobbiesProps, HobbiesState } from "./Hobbies.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";
import axios from "axios";
import HobbiesList from "./HobbiesList/HobbiesList";
import AddCategory from "./AddCategory/AddCategory";

class Hobbies extends Component<HobbiesProps, HobbiesState> {
    constructor(props: HobbiesProps) {
        super(props);

        this.state = {
            hobbies: []
        };
    }

    getHobbies = () => {
        return new Promise((resolve, reject) => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-hobbies`, {
                        headers: {
                            Authorization: `Bearer ${this.context.token}`
                        }
                    })
                    .then(response => {
                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                hobbies: data.result.hobbies
                            });
                        }

                        resolve(response);
                    })
                    .catch(err => {
                        this.context.checkTokenExpiration(err.response.status);
                    });
            } catch (err) {
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    handleHobbyBlock = id => {
        this.context.handleShowLoader(true);
        return new Promise(async (resolve, reject) => {
            try {
                let data = JSON.stringify({
                    id: id
                });

                axios
                    .post(`${this.context.API_URL}block-hobby`, data, {
                        headers: {
                            "Content-Type": "application/json",
                            Authorization: `Bearer ${this.context.token}`
                        }
                    })
                    .then(response => {
                        let newHobbiesState = this.state.hobbies;

                        newHobbiesState.map((hobby, i) => {
                            if (hobby.id === id) {
                                hobby.blocked = !hobby.blocked;
                            }
                        });

                        this.setState({ hobbies: newHobbiesState });

                        this.context.handleShowAlert(
                            "Successfully changed hobby status",
                            "success"
                        );
                        resolve(response);
                    })
                    .catch(err => {
                        this.context.checkTokenExpiration(err.response.status);
                    });
            } catch (err) {
                console.log(err);
                this.context.handleShowAlert(
                    "Cannot changed hobby status",
                    "danger"
                );
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    addNewHobby = name => {
        if (!name) {
            this.context.handleShowAlert(
                "Please, provide hobby name",
                "danger"
            );
        } else {
            this.context.handleShowLoader(true);
            return new Promise(async (resolve, reject) => {
                try {
                    let data = JSON.stringify({
                        name: name
                    });

                    axios
                        .post(`${this.context.API_URL}add-hobby`, data, {
                            headers: {
                                "Content-Type": "application/json",
                                Authorization: `Bearer ${this.context.token}`
                            }
                        })
                        .then(response => {
                            this.getHobbies();

                            this.context.handleShowAlert(
                                "Successfully added new hobby",
                                "success"
                            );

                            resolve(response);
                        })
                        .catch(err => {
                            this.context.checkTokenExpiration(
                                err.response.status
                            );
                        });
                } catch (err) {
                    this.context.handleShowAlert(
                        "Cannot added new hobby",
                        "danger"
                    );
                    reject(err);
                } finally {
                    this.context.handleShowLoader(false);
                }
            });
        }
    };

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Hobbies");

        this.getHobbies();
    };

    render() {
        const { hobbies } = this.state;

        return (
            <DashboardContainer>
                <Header text="Hobbies List" />

                <AddCategory addNewHobby={this.addNewHobby} />

                <HobbiesList
                    hobbies={hobbies}
                    handleHobbyBlock={this.handleHobbyBlock}
                />
            </DashboardContainer>
        );
    }
}

Hobbies.contextType = MainContext;
export default Hobbies;
