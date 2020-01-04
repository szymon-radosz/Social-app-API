import React, { Component } from "react";
import { TranslationsProps, TranslationsState } from "./Translations.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";

class Translations extends Component<TranslationsProps, TranslationsState> {
    constructor(props: TranslationsProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Translations");
    };

    render() {
        return (
            <DashboardContainer>
                <Header text="Translations" />
            </DashboardContainer>
        );
    }
}
Translations.contextType = MainContext;
export default Translations;
