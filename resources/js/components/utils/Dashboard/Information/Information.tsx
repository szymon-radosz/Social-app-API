import React, { Component } from "react";
import { InformationProps, InformationState } from "./Information.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

class Information extends Component<InformationProps, InformationState> {
    constructor(props: InformationProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Information");
    };

    render() {
        return (
            <DashboardContainer>
                <div>Information</div>
            </DashboardContainer>
        );
    }
}
Information.contextType = MainContext;
export default Information;
