import React, { Component } from "react";
import { SlidesProps, SlidesState } from "./Slides.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

class Slides extends Component<SlidesProps, SlidesState> {
    constructor(props: SlidesProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Slides");
    };

    render() {
        return (
            <DashboardContainer>
                <div>Slides</div>
            </DashboardContainer>
        );
    }
}

Slides.contextType = MainContext;
export default Slides;
