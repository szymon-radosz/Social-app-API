import React, { Component } from "react";
import {
    ForumCategoriesProps,
    ForumCategoriesState
} from "./ForumCategories.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";
import axios from "axios";
import ForumCategoryList from "./ForumCategoryList/ForumCategoryList";
import AddCategory from "./AddCategory/AddCategory";

class ForumCategories extends Component<
    ForumCategoriesProps,
    ForumCategoriesState
> {
    constructor(props: ForumCategoriesProps) {
        super(props);

        this.state = {
            categories: []
        };
    }

    getCategories = () => {
        return new Promise((resolve, reject) => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-forum-categories`, {
                        headers: {
                            Authorization: `Bearer ${this.context.token}`
                        }
                    })
                    .then(response => {
                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                categories: data.result.categories
                            });
                        }

                        resolve(response);
                    })
                    .catch(err => {
                        this.context.checkTokenExpiration(err.response.status);
                    });
            } catch (err) {
                console.log(err);
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    handleCategoryBlock = id => {
        this.context.handleShowLoader(true);
        return new Promise(async (resolve, reject) => {
            try {
                let data = JSON.stringify({
                    id: id
                });

                axios
                    .post(`${this.context.API_URL}block-forum-category`, data, {
                        headers: {
                            "Content-Type": "application/json",
                            Authorization: `Bearer ${this.context.token}`
                        }
                    })
                    .then(response => {
                        let newCategoriesState = this.state.categories;

                        newCategoriesState.map((category, i) => {
                            if (category.id === id) {
                                category.blocked = !category.blocked;
                            }
                        });

                        this.setState({ categories: newCategoriesState });

                        this.context.handleShowAlert(
                            "Successfully changed category status",
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
                    "Cannot changed category status",
                    "danger"
                );
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    addNewCategory = name => {
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
                        .post(
                            `${this.context.API_URL}add-forum-category`,
                            data,
                            {
                                headers: {
                                    "Content-Type": "application/json",
                                    Authorization: `Bearer ${this.context.token}`
                                }
                            }
                        )
                        .then(response => {
                            this.getCategories();

                            this.context.handleShowAlert(
                                "Successfully added new category",
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
                        "Cannot added new category",
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
        this.context.handlAactiveMenuSection("Forum Categories");

        this.getCategories();
    };

    render() {
        const { categories } = this.state;

        return (
            <DashboardContainer>
                <Header text="Forum Categories" />

                <AddCategory addNewCategory={this.addNewCategory} />

                <ForumCategoryList
                    categories={categories}
                    handleCategoryBlock={this.handleCategoryBlock}
                />
            </DashboardContainer>
        );
    }
}

ForumCategories.contextType = MainContext;
export default ForumCategories;
