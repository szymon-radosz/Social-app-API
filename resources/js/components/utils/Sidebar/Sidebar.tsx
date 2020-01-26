import React, { useContext } from "react";
import { MainContext } from "./../../MainContext";

const Sidebar = () => {
    const context = useContext(MainContext);

    return (
        <div className="sidebar">
            <ul className={`list-active-${context.activeMenuSection}`}>
                <li
                    className={
                        context.activeMenuSection === "Dashboard"
                            ? "sidebar__item sidebar__item--1 sidebar__item--active sidebar__item--active--1"
                            : "sidebar__item sidebar__item--1"
                    }
                >
                    <div className="sidebar__item--wrapper">
                        {context.activeMenuSection === "Dashboard" && (
                            <div className="active-sidebar-item"></div>
                        )}
                        <a
                            href="#"
                            onClick={() => {
                                context.handleChangePath("/dashboard");
                                context.handlAactiveMenuSection("Dashboard");
                            }}
                        >
                            <img
                                className="sidebar-icon"
                                src="/images/stats.png"
                                alt="Icon made by Freepik from www.flaticon.com"
                                title="Dashboard"
                            />
                        </a>
                        {context.showSidebarText && (
                            <a
                                href="#"
                                onClick={() => {
                                    context.handleChangePath("/dashboard");
                                    context.handlAactiveMenuSection(
                                        "Dashboard"
                                    );
                                }}
                            >
                                <p className="sidebar__item--text">Dashboard</p>
                            </a>
                        )}
                    </div>
                </li>
                <li
                    className={
                        context.activeMenuSection === "Users"
                            ? "sidebar__item sidebar__item--2 sidebar__item--active sidebar__item--active--2"
                            : "sidebar__item sidebar__item--2"
                    }
                >
                    <div className="sidebar__item--wrapper">
                        {context.activeMenuSection === "Users" && (
                            <div className="active-sidebar-item"></div>
                        )}
                        <a
                            href="#"
                            onClick={() => {
                                context.handleChangePath("/users");
                                context.handlAactiveMenuSection("Users");
                            }}
                        >
                            <img
                                className="sidebar-icon"
                                src="/images/group.png"
                                alt="Icon made by Freepik from www.flaticon.com"
                                title="Users"
                            />
                        </a>
                        {context.showSidebarText && (
                            <a
                                href="#"
                                onClick={() => {
                                    context.handleChangePath("/users");
                                    context.handlAactiveMenuSection("Users");
                                }}
                            >
                                <p className="sidebar__item--text">Users</p>
                            </a>
                        )}
                    </div>
                </li>
                <li
                    className={
                        context.activeMenuSection === "Forum Categories"
                            ? "sidebar__item sidebar__item--3 sidebar__item--active sidebar__item--active--3"
                            : "sidebar__item sidebar__item--3"
                    }
                >
                    <div className="sidebar__item--wrapper">
                        {context.activeMenuSection === "Forum Categories" && (
                            <div className="active-sidebar-item"></div>
                        )}
                        <a
                            href="#"
                            onClick={() => {
                                context.handleChangePath("/forum-categories");
                                context.handlAactiveMenuSection(
                                    "Forum Categories"
                                );
                            }}
                        >
                            <img
                                className="sidebar-icon"
                                src="/images/forum-icon.png"
                                alt="Icon made by Freepik from www.flaticon.com"
                                title="Forum Categories"
                            />
                        </a>
                        {context.showSidebarText && (
                            <a
                                href="#"
                                onClick={() => {
                                    context.handleChangePath("/forum-categories");
                                    context.handlAactiveMenuSection(
                                        "Forum Categories"
                                    );
                                }}
                            >
                                <p className="sidebar__item--text">
                                    Forum Categories
                                </p>
                            </a>
                        )}
                    </div>
                </li>
                <li
                    className={
                        context.activeMenuSection === "Hobbies"
                            ? "sidebar__item sidebar__item--4 sidebar__item--active sidebar__item--active--4"
                            : "sidebar__item sidebar__item--4"
                    }
                >
                    <div className="sidebar__item--wrapper">
                        {context.activeMenuSection === "Hobbies" && (
                            <div className="active-sidebar-item"></div>
                        )}
                        <a
                            href="#"
                            onClick={() => {
                                context.handleChangePath("/hobbies");
                                context.handlAactiveMenuSection("Hobbies");
                            }}
                        >
                            <img
                                className="sidebar-icon"
                                src="/images/ball.png"
                                alt="Icon made by Freepik from www.flaticon.com"
                                title="Hobbies"
                            />
                        </a>
                        {context.showSidebarText && (
                            <a
                                href="#"
                                onClick={() => {
                                    context.handleChangePath("/hobbies");
                                    context.handlAactiveMenuSection("Hobbies");
                                }}
                            >
                                <p className="sidebar__item--text">
                                    Hobbies List
                                </p>
                            </a>
                        )}
                    </div>
                </li>
                <li
                    className={
                        context.activeMenuSection === "Translations"
                            ? "sidebar__item sidebar__item--5 sidebar__item--active sidebar__item--active--5"
                            : "sidebar__item sidebar__item--5"
                    }
                >
                    <div className="sidebar__item--wrapper">
                        {context.activeMenuSection === "Translations" && (
                            <div className="active-sidebar-item"></div>
                        )}
                        <a
                            href="#"
                            onClick={() => {
                                context.handleChangePath("/translations");
                                context.handlAactiveMenuSection("Translations");
                            }}
                        >
                            <img
                                className="sidebar-icon"
                                src="/images/translator.png"
                                alt="Icon made by Freepik from www.flaticon.com"
                                title="Translations"
                            />
                        </a>
                        {context.showSidebarText && (
                            <a
                                href="#"
                                onClick={() => {
                                    context.handleChangePath("/translations");
                                    context.handlAactiveMenuSection(
                                        "Translations"
                                    );
                                }}
                            >
                                <p className="sidebar__item--text">
                                    Translations
                                </p>
                            </a>
                        )}
                    </div>
                </li>
                <li
                    className={
                        context.activeMenuSection === "Register"
                            ? "sidebar__item sidebar__item--6 sidebar__item--active sidebar__item--active--6"
                            : "sidebar__item sidebar__item--6"
                    }
                >
                    <div className="sidebar__item--wrapper">
                        {context.activeMenuSection === "Register" && (
                            <div className="active-sidebar-item"></div>
                        )}
                        <a
                            href="#"
                            onClick={() => {
                                context.handleChangePath("/register");
                                context.handlAactiveMenuSection("Register");
                            }}
                        >
                            <img
                                className="sidebar-icon"
                                src="/images/avatar.png"
                                alt="Icon made by Gregor Cresnar from www.flaticon.com"
                                title="Register"
                            />
                        </a>
                        {context.showSidebarText && (
                            <a
                                href="#"
                                onClick={() => {
                                    context.handleChangePath("/register");
                                    context.handlAactiveMenuSection("Register");
                                }}
                            >
                                <p className="sidebar__item--text">Register</p>
                            </a>
                        )}
                    </div>
                </li>
                <li className="sidebar__item sidebar__item--7">
                    <div className="sidebar__item--wrapper"></div>
                </li>
            </ul>
        </div>
    );
};

export default Sidebar;
