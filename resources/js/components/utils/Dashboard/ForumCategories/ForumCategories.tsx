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
        return new Promise(resolve => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-forum-categories`)
                    .then(response => {
                        console.log(["response", response, response.status]);

                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                categories: data.result.categories
                            });
                        }

                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    handleCategoryChangeName = (id, name) => {
        console.log(["handleCategoryChangeName", id, name]);

        this.context.handleShowLoader(true);
        return new Promise(async resolve => {
            try {
                let data = JSON.stringify({
                    id: id,
                    name: name
                });

                axios
                    .post(
                        `${this.context.API_URL}update-forum-category`,
                        data,
                        {
                            headers: {
                                "Content-Type": "application/json"
                            }
                        }
                    )
                    .then(response => {
                        console.log(["response", response, response.status]);

                        const { data } = response;

                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    handleCategoryBlock = id => {
        console.log(["block", id]);

        this.context.handleShowLoader(true);
        return new Promise(async resolve => {
            try {
                let data = JSON.stringify({
                    id: id
                });

                axios
                    .post(`${this.context.API_URL}block-forum-category`, data, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => {
                        console.log([
                            "response",
                            response,
                            response.status,
                            this.state.categories
                        ]);

                        let newCategoriesState = this.state.categories;

                        newCategoriesState.map((category, i) => {
                            if (category.id === id) {
                                category.blocked = !category.blocked;
                            }
                        });

                        this.setState({ categories: newCategoriesState });
                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    addNewCategory = name => {
        console.log(["addNewCategory", name]);

        this.context.handleShowLoader(true);
        return new Promise(async resolve => {
            try {
                let data = JSON.stringify({
                    name: name
                });

                axios
                    .post(`${this.context.API_URL}add-forum-category`, data, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => {
                        console.log([
                            "response",
                            response,
                            response.status,
                            this.state.categories
                        ]);

                        this.getCategories();

                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
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
                    handleCategoryChangeName={this.handleCategoryChangeName}
                    categories={categories}
                    handleCategoryBlock={this.handleCategoryBlock}
                />
            </DashboardContainer>
        );
    }
}

ForumCategories.contextType = MainContext;
export default ForumCategories;
