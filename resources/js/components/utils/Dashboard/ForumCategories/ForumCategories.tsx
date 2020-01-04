import React, { Component } from "react";
import {
    ForumCategoriesProps,
    ForumCategoriesState
} from "./ForumCategories.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

class ForumCategories extends Component<
    ForumCategoriesProps,
    ForumCategoriesState
> {
    constructor(props: ForumCategoriesProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Forum Categories");
    };

    render() {
        return (
            <DashboardContainer>
                <div>ForumCategories</div>
            </DashboardContainer>
        );
    }
}

ForumCategories.contextType = MainContext;
export default ForumCategories;
