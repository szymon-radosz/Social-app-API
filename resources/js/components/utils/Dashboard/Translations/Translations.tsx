import React, { Component } from "react";
import { TranslationsProps, TranslationsState } from "./Translations.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";
import axios from "axios";
import TranslationList from "./TranslationList/TranslationList";
import AddTranslation from "./AddTranslation/AddTranslation";

class Translations extends Component<TranslationsProps, TranslationsState> {
    constructor(props: TranslationsProps) {
        super(props);

        this.state = {
            translations: []
        };
    }

    getTranslations = () => {
        console.log("getTranslations");
        return new Promise((resolve, reject) => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-translations`)
                    .then(response => {
                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                translations: data.result.translations
                            });
                        }

                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    handleTranslationSave = (id, name, en, de, fr, es, zh) => {
        console.log("handleTranslationSave");

        this.context.handleShowLoader(true);
        return new Promise(async (resolve, reject) => {
            try {
                let data = JSON.stringify({
                    id: id,
                    name: name,
                    en: en,
                    de: de,
                    fr: fr,
                    es: es,
                    zh: zh
                });

                axios
                    .post(`${this.context.API_URL}update-translation`, data, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => {
                        this.context.handleShowAlert(
                            "Successfully updated translation",
                            "success"
                        );

                        resolve(response);
                    });
            } catch (err) {
                this.context.handleShowAlert(
                    "Cannot update category",
                    "danger"
                );
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    handleTranslationRemove = id => {
        this.context.handleShowLoader(true);
        return new Promise(async (resolve, reject) => {
            try {
                let data = JSON.stringify({
                    id: id
                });

                axios
                    .post(`${this.context.API_URL}remove-translation`, data, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => {
                        this.getTranslations();

                        this.context.handleShowAlert(
                            "Successfully removed translation",
                            "success"
                        );

                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
                this.context.handleShowAlert(
                    "Cannot remove translation",
                    "danger"
                );
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    addNewTranslation = name => {
        if (!name) {
            this.context.handleShowAlert(
                "Please, provide category name",
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
                        .post(`${this.context.API_URL}add-translation`, data, {
                            headers: {
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => {
                            this.getTranslations();

                            this.context.handleShowAlert(
                                "Successfully added new translation",
                                "success"
                            );

                            resolve(response);
                        });
                } catch (err) {
                    console.log(err);
                    this.context.handleShowAlert(
                        "Cannot added new translation",
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
        this.context.handlAactiveMenuSection("Translations");

        this.getTranslations();
    };

    render() {
        const { translations } = this.state;
        return (
            <DashboardContainer>
                <Header text="Translations" />

                <AddTranslation addNewTranslation={this.addNewTranslation} />

                <TranslationList
                    translations={translations}
                    handleTranslationSave={this.handleTranslationSave}
                    handleTranslationRemove={this.handleTranslationRemove}
                />
            </DashboardContainer>
        );
    }
}
Translations.contextType = MainContext;
export default Translations;
