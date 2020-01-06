import React, { Component } from "react";
import { DashboardProps, DashboardState } from "./Dashboard.interface";
import { Redirect } from "react-router-dom";
import DashboardContainer from "./../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../MainContext";
import Header from "./utils/Header";
import DashboardInfoRect from "./utils/DashboardInfoRect";
import axios from "axios";

class Dashboard extends Component<DashboardProps, DashboardState> {
    routes: any;

    constructor(props: DashboardProps) {
        super(props);

        this.state = {
            redirectLogin: true,
            usersCount: 0,
            ForumPostsCount: 0,
            ForumCommentsCount: 0
        };
    }

    getUsers = () => {
        return new Promise(resolve => {
            this.context.handleShowLoader(true);
            try {
                axios.get(`${this.context.API_URL}get-users`).then(response => {
                    console.log(["response", response, response.status]);

                    const { data } = response;

                    if (response.status === 200) {
                        this.setState({ usersCount: data.result.users });
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

    getForumPosts = () => {
        return new Promise(resolve => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-forum-posts`)
                    .then(response => {
                        console.log(["response", response, response.status]);

                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                ForumPostsCount: data.result.forumPosts
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

    getForumComments = () => {
        return new Promise(resolve => {
            this.context.handleShowLoader(true);
            try {
                axios
                    .get(`${this.context.API_URL}get-forum-comments`)
                    .then(response => {
                        console.log(["response", response, response.status]);

                        const { data } = response;

                        if (response.status === 200) {
                            this.setState({
                                ForumCommentsCount: data.result.forumComments
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

    getStatsInfo = async () => {
        await this.getUsers();
        await this.getForumPosts();
        await this.getForumComments();
    };

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Dashboard");

        if (this.context && !this.context.userLoggedIn) {
            console.log(this.context.userLoggedIn);
            this.setState({ redirectLogin: true });
        }

        this.getStatsInfo();
    };

    render() {
        const {
            redirectLogin,
            usersCount,
            ForumPostsCount,
            ForumCommentsCount
        } = this.state;

        if (!redirectLogin) {
            return <Redirect to="/login" />;
        }

        return (
            <DashboardContainer>
                <Header text="Statistics - Current Week" />

                <div className="dashboard__rect-container row">
                    <DashboardInfoRect
                        icon="/images/group.png"
                        headerText="New Users"
                        number={usersCount}
                    />

                    <DashboardInfoRect
                        icon="/images/forum-icon.png"
                        headerText="New Forum Posts"
                        number={ForumPostsCount}
                    />

                    <DashboardInfoRect
                        icon="/images/forum-icon.png"
                        headerText="New Forum Comments"
                        number={ForumCommentsCount}
                    />
                </div>
            </DashboardContainer>
        );
    }
}

Dashboard.contextType = MainContext;
export default Dashboard;
