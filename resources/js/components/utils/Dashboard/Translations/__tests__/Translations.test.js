import React from "react";
import "@testing-library/jest-dom/extend-expect";
import { mount, shallow } from "enzyme";
import sinon from "sinon";
import Translations from "./../Translations";
import TranslationList from "./../TranslationList/TranslationList";
import TranslationListRow from "./../TranslationList/TranslationListRow/TranslationListRow";
import AddTranslation from "./../AddTranslation/AddTranslation";
import DashboardContainer from "./../../../DashboardContainer/DashboardContainer";
import Header from "./../../utils/Header";

const translations = [
    {
        id: 1,
        bloced: true,
        name: "category1",
        created_at: "2020-01-01 18:00:00",
        en: "en1",
        de: "de1",
        fr: "fr1",
        es: "es1",
        zh: "zh1"
    },
    {
        id: 2,
        bloced: false,
        name: "category2",
        created_at: "2020-01-01 18:10:00",
        en: "en2",
        de: "de2",
        fr: "fr2",
        es: "es2",
        zh: "zh2"
    }
];

describe("<Translations />", () => {
    const wrapper = mount(<Translations />);

    const wrapperList = mount(<TranslationList translations={translations} />);

    it("renders <DashboardContainer /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(DashboardContainer)).toHaveLength(1);
    });

    it("renders <Header /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(Header)).toHaveLength(1);
    });

    it("renders <TranslationList /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(TranslationList)).toHaveLength(1);
    });

    it("renders <AddTranslation /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(AddTranslation)).toHaveLength(1);
    });

    it("renders <TranslationListRow /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapperList.find(TranslationListRow)).toHaveLength(2);
    });

    it("renders html element", () => {
        expect(wrapper.find(".table-responsive")).toHaveLength(1);
        expect(wrapper.find(".table-responsive")).not.toHaveLength(2);
        expect(wrapper.find(".table")).toHaveLength(1);
        expect(wrapperList.find(".tranlation__row")).toHaveLength(2);
        expect(wrapper.find("form")).toHaveLength(1);
        expect(wrapper.find("input")).toHaveLength(1);
        expect(wrapper.find(".btn")).toHaveLength(1);
    });

    it("submit event when click submit", () => {
        const onButtonClick = sinon.spy();
        const wrapper = shallow(
            <AddTranslation handleAddNewTranslation={onButtonClick} />
        );
        wrapper.find("button").simulate("click");
        expect(onButtonClick.called).toBeTruthy();
        expect(onButtonClick.calledOnce).toBeTruthy();
    });
});
