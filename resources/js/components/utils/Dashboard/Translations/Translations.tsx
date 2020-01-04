import React, { Component } from "react";
import { TranslationsProps, TranslationsState } from "./Translations.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";

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
                <div>Translations</div>
            </DashboardContainer>
        );
    }
}
Translations.contextType = MainContext;
export default Translations;
