import React, { Component } from "react";
import { CustomizeProps, CustomizeState } from "./Customize.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";

class Customize extends Component<CustomizeProps, CustomizeState> {
    constructor(props: CustomizeProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Customize");
    };

    render() {
        return (
            <DashboardContainer>
                <Header text="Customize" />
            </DashboardContainer>
        );
    }
}
Customize.contextType = MainContext;
export default Customize;
