import React from "react";
import "@testing-library/jest-dom/extend-expect";
import { mount, shallow } from "enzyme";
import sinon from "sinon";
import Hobbies from "./../Hobbies";
import HobbiesList from "./../HobbiesList/HobbiesList";
import HobbyRow from "./../HobbiesList/HobbyRow/HobbyRow";
import AddCategory from "./../AddCategory/AddCategory";
import DashboardContainer from "./../../../DashboardContainer/DashboardContainer";
import Header from "./../../utils/Header";

const hobbies = [
    {
        id: 1,
        bloced: true,
        name: "category1",
        created_at: "2020-01-01 18:00:00"
    },
    {
        id: 2,
        bloced: false,
        name: "category2",
        created_at: "2020-01-01 18:10:00"
    }
];

describe("<Hobbies />", () => {
    const wrapper = mount(<Hobbies />);

    const wrapperList = mount(<HobbiesList hobbies={hobbies} />);

    it("renders <DashboardContainer /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(DashboardContainer)).toHaveLength(1);
    });

    it("renders <Header /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(Header)).toHaveLength(1);
    });

    it("renders <HobbiesList /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(HobbiesList)).toHaveLength(1);
    });

    it("renders <AddCategory /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(AddCategory)).toHaveLength(1);
    });

    it("renders <HobbyRow /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapperList.find(HobbyRow)).toHaveLength(2);
    });

    it("renders html element", () => {
        expect(wrapper.find(".table-responsive")).toHaveLength(1);
        expect(wrapper.find(".table-responsive")).not.toHaveLength(2);
        expect(wrapper.find(".table")).toHaveLength(1);
        expect(wrapperList.find(".hobby__row")).toHaveLength(2);
        expect(wrapper.find("form")).toHaveLength(1);
        expect(wrapper.find("input")).toHaveLength(1);
        expect(wrapper.find(".btn")).toHaveLength(1);
    });

    it("submit event when click submit", () => {
        const onButtonClick = sinon.spy();
        const wrapper = shallow(
            <AddCategory handleAddNewHobby={onButtonClick} />
        );
        wrapper.find("button").simulate("click");
        expect(onButtonClick.called).toBeTruthy();
        expect(onButtonClick.calledOnce).toBeTruthy();
    });
});
