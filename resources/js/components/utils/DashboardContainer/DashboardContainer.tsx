import React from "react";
import TopBar from "./../TopBar/TopBar";
import Sidebar from "./../Sidebar/Sidebar";

const DashboardContainer = ({ children }) => {
    return (
        <>
            <TopBar />
            <div className="dashboard__container">
                <Sidebar />
                <div className="dashboard__container--content">{children}</div>
            </div>
        </>
    );
};

export default DashboardContainer;
