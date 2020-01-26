import React from "react";

const HobbyRow = ({ hobby, i, handleHobbyBlock }) => {
    return (
        <tr className={hobby.blocked ? "danger-row hobby__row" : "hobby__row"}>
            <th scope="row">{i + 1}</th>
            <td>{hobby.name}</td>
            <td>{hobby.created_at && hobby.created_at}</td>
            <td>
                <button
                    type="button"
                    onClick={() => handleHobbyBlock(hobby.id)}
                    className="btn blue-btn"
                >
                    {hobby.blocked ? "Unblock" : "Block"}
                </button>
            </td>
        </tr>
    );
};

export default HobbyRow;
