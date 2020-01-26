import React from "react";
import "@testing-library/jest-dom/extend-expect";
import { mount, shallow } from "enzyme";
import sinon from "sinon";
import Register from "./../Register";
import RegisterForm from "./../RegisterForm/RegisterForm";
import DashboardContainer from "./../../../DashboardContainer/DashboardContainer";
import Header from "./../../utils/Header";

describe("<Register />", () => {
    const wrapper = mount(<Register />);

    it("renders <DashboardContainer /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(DashboardContainer)).toHaveLength(1);
    });

    it("renders <Header /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(Header)).toHaveLength(1);
    });

    it("renders <RegisterForm /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(RegisterForm)).toHaveLength(1);
    });

    it("renders html element", () => {
        expect(wrapper.find("form")).toHaveLength(1);
        expect(wrapper.find("input")).toHaveLength(3);
        expect(wrapper.find(".btn")).toHaveLength(1);
    });

    it("submit event when click submit", () => {
        const onButtonClick = sinon.spy();
        const wrapper = shallow(
            <RegisterForm handleRegisterUser={onButtonClick} />
        );
        wrapper.find("button").simulate("click");
        expect(onButtonClick.called).toBeTruthy();
        expect(onButtonClick.calledOnce).toBeTruthy();
    });
});
