import React, { Component } from "react";
import { UsersProps, UsersState } from "./Users.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";
import ReactPaginate from "react-paginate";
import UserList from "./UserList/UserList";
import axios from "axios";
import UserSearchBox from "./UserSearchBox/UserSearchBox";

class Users extends Component<UsersProps, UsersState> {
    constructor(props: UsersProps) {
        super(props);

        this.state = {
            users: [],
            lastPage: 0,
            path: "",
            currentPage: 0,
            count: 0,
            from: 0,
            paginatePage: 0
        };
    }

    getUsers = () => {
        return new Promise((resolve, reject) => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-users-list`)
                    .then(response => {
                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                users: data.result.users.data,
                                lastPage: data.result.users.last_page,
                                path: data.result.users.path,
                                count: data.result.users.total,
                                from: data.result.users.from,
                                paginatePage: 0
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

    handlePageChange = data => {
        this.context.handleShowLoader(true);
        return new Promise(async (resolve, reject) => {
            try {
                axios
                    .get(
                        `${
                            this.context.API_URL
                        }get-users-list?page=${data.selected + 1}`
                    )
                    .then(response => {
                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                users: data.result.users.data,
                                lastPage: data.result.users.last_page,
                                path: data.result.users.path,
                                count: data.result.users.total,
                                from: data.result.users.from,
                                paginatePage: data.selected
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

    getUserByQuery = query => {
        if (!query) {
            this.getUsers();
        } else {
            this.context.handleShowLoader(true);
            return new Promise(async (resolve, reject) => {
                try {
                    let data = JSON.stringify({
                        query: query
                    });

                    axios
                        .post(
                            `${this.context.API_URL}get-users-by-query`,
                            data,
                            {
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            }
                        )
                        .then(response => {
                            const { data } = response;

                            if (response.status === 200) {
                                this.setState({
                                    users: data.result.users.data,
                                    lastPage: data.result.users.last_page,
                                    path: data.result.users.path,
                                    count: data.result.users.total,
                                    from: data.result.users.from,
                                    paginatePage: 0
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
        }
    };

    handleUserBlock = id => {
        this.context.handleShowLoader(true);
        return new Promise(async (resolve, reject) => {
            try {
                let data = JSON.stringify({
                    id: id
                });

                axios
                    .post(`${this.context.API_URL}block-user`, data, {
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => {
                        let newUsersState = this.state.users;

                        newUsersState.map((user, i) => {
                            if (user.id === id) {
                                user.blocked = !user.blocked;
                            }
                        });

                        this.setState({ users: newUsersState });

                        this.context.handleShowAlert(
                            "Successfully changed user status",
                            "success"
                        );
                        resolve(response);
                    });
            } catch (err) {
                console.log(err);
                this.context.handleShowAlert(
                    "Cannot blocked the user",
                    "danger"
                );
                reject(err);
            } finally {
                this.context.handleShowLoader(false);
            }
        });
    };

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Users");

        this.getUsers();
    };

    render() {
        const { users, lastPage, paginatePage } = this.state;

        return (
            <DashboardContainer>
                <Header text="Users" />

                <UserSearchBox getUserByQuery={this.getUserByQuery} />

                <UserList
                    users={users}
                    handleUserBlock={this.handleUserBlock}
                />

                <nav aria-label="Page navigation example">
                    <ReactPaginate
                        previousLabel={"prev"}
                        nextLabel={"next"}
                        breakLabel={"..."}
                        breakClassName={"break-me"}
                        pageCount={lastPage}
                        marginPagesDisplayed={1}
                        pageRangeDisplayed={2}
                        onPageChange={this.handlePageChange}
                        containerClassName={"pagination"}
                        subContainerClassName={"pages pagination"}
                        activeClassName={"active"}
                        pageClassName={"page-item"}
                        pageLinkClassName={"page-link"}
                        previousClassName={"page-item"}
                        previousLinkClassName={"page-link"}
                        nextClassName={"page-item"}
                        nextLinkClassName={"page-link"}
                        forcePage={paginatePage}
                    />
                </nav>
            </DashboardContainer>
        );
    }
}

Users.contextType = MainContext;
export default Users;
