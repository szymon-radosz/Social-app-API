import React, { Component } from "react";
import { SlidesProps, SlidesState } from "./Slides.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";

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
                <Header text="Slides" />
            </DashboardContainer>
        );
    }
}

Slides.contextType = MainContext;
export default Slides;
