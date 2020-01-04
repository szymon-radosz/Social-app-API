import React, { Component } from "react";
import { CustomizeProps, CustomizeState } from "./Customize.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

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
                <div>Customize</div>
            </DashboardContainer>
        );
    }
}
Customize.contextType = MainContext;
export default Customize;
