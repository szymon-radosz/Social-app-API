import React from "react";
import HobbyRow from "./HobbyRow/HobbyRow";
import TableLegend from "./../../utils/TableLegend";

const legends = [
    {
        text: "Blocked Hobbies",
        color: "#ffd4d8"
    }
];

const HobbiesList = ({ hobbies, handleHobbyBlock }) => {
    return (
        <>
            <div className="table-responsive">
                <table className="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Blocked</th>
                        </tr>
                    </thead>
                    <tbody>
                        {hobbies &&
                            hobbies.map((hobby, i) => {
                                return (
                                    <HobbyRow
                                        key={i}
                                        hobby={hobby}
                                        i={i}
                                        handleHobbyBlock={handleHobbyBlock}
                                    />
                                );
                            })}
                    </tbody>
                </table>
            </div>
            <TableLegend legends={legends} />
        </>
    );
};

export default HobbiesList;
