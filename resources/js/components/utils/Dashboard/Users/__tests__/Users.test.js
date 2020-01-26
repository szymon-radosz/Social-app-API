import React from "react";
import "@testing-library/jest-dom/extend-expect";
import { mount, shallow } from "enzyme";
import sinon from "sinon";
import Users from "./../Users";
import UserList from "./../UserList/UserList";
import UserRow from "./../UserList/UserRow/UserRow";
import UserSearchBox from "./../UserSearchBox/UserSearchBox";
import DashboardContainer from "./../../../DashboardContainer/DashboardContainer";
import Header from "./../../utils/Header";

const users = [
    {
        id: 1,
        blocked: true,
        name: "category1",
        created_at: "2020-01-01 18:00:00",
        name: "user1",
        nickanme: "nickname1",
        email: "email1@test.com",
        age: 10,
        description: "test",
        platform: "android",
        varified: true,
        user_filled_info: true,
        location_string: "test"
    },
    {
        id: 2,
        blocked: true,
        name: "category1",
        created_at: "2020-01-01 18:00:00",
        name: "user2",
        nickanme: "nickname2",
        email: "email2@test.com",
        age: 10,
        description: "test",
        platform: "android",
        varified: true,
        user_filled_info: true,
        location_string: "test"
    }
];

describe("<Users />", () => {
    const wrapper = mount(<Users />);

    const wrapperList = mount(<UserList users={users} />);

    it("renders <DashboardContainer /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(DashboardContainer)).toHaveLength(1);
    });

    it("renders <Header /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(Header)).toHaveLength(1);
    });

    it("renders <UserList /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(UserList)).toHaveLength(1);
    });

    it("renders <UserSearchBox /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapper.find(UserSearchBox)).toHaveLength(1);
    });

    it("renders <UserRow /> components", () => {
        //console.log(wrapper.debug());
        expect(wrapperList.find(UserRow)).toHaveLength(2);
    });

    it("renders html element", () => {
        expect(wrapper.find(".table-responsive")).toHaveLength(1);
        expect(wrapper.find(".table-responsive")).not.toHaveLength(2);
        expect(wrapper.find(".table")).toHaveLength(1);
        expect(wrapperList.find(".user__row")).toHaveLength(2);
        expect(wrapper.find("form")).toHaveLength(1);
        expect(wrapper.find("input")).toHaveLength(1);
        expect(wrapper.find(".btn")).toHaveLength(1);
    });

    it("submit event when click submit", () => {
        const onButtonClick = sinon.spy();
        const wrapper = shallow(
            <UserSearchBox getUserByQuery={onButtonClick} />
        );
        wrapper.find("button").simulate("click");
        expect(onButtonClick.called).toBeTruthy();
        expect(onButtonClick.calledOnce).toBeTruthy();
    });
});
