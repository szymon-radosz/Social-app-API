import React from "react";
import "@testing-library/jest-dom/extend-expect";
import { mount, shallow } from "enzyme";
import sinon from "sinon";
import ForumCategories from "./../ForumCategories";
import ForumCategoryList from "./../ForumCategoryList/ForumCategoryList";
import ForumCategoryRow from "./../ForumCategoryList/ForumCategoryRow/ForumCategoryRow";
import AddCategory from "./../AddCategory/AddCategory";
import DashboardContainer from "./../../../DashboardContainer/DashboardContainer";
import Header from "./../../utils/Header";

const categories = [
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

describe("<ForumCategories />", () => {
    const wrapper = mount(<ForumCategories />);

    const wrapperList = mount(<ForumCategoryList categories={categories} />);

    it("renders <DashboardContainer /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(DashboardContainer)).toHaveLength(1);
    });

    it("renders <Header /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(Header)).toHaveLength(1);
    });

    it("renders <ForumCategoryList /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(ForumCategoryList)).toHaveLength(1);
    });

    it("renders <AddCategory /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(AddCategory)).toHaveLength(1);
    });

    it("renders <ForumCategoryRow /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapperList.find(ForumCategoryRow)).toHaveLength(2);
    });

    it("renders html element", () => {
        expect(wrapper.find(".table-responsive")).toHaveLength(1);
        expect(wrapper.find(".table-responsive")).not.toHaveLength(2);
        expect(wrapper.find(".table")).toHaveLength(1);
        expect(wrapperList.find(".category__row")).toHaveLength(2);
        expect(wrapper.find("form")).toHaveLength(1);
        expect(wrapper.find("input")).toHaveLength(1);
        expect(wrapper.find(".btn")).toHaveLength(1);
    });

    it("submit event when click submit", () => {
        const onButtonClick = sinon.spy();
        const wrapper = shallow(
            <AddCategory handleAddNewCategory={onButtonClick} />
        );
        wrapper.find("button").simulate("click");
        expect(onButtonClick.called).toBeTruthy();
        expect(onButtonClick.calledOnce).toBeTruthy();
    });
});
