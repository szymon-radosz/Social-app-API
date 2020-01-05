import React from "react";

const UserRow = ({ user, i, handleUserBlock }) => {
    return (
        <tr className={user.blocked && "danger-row"}>
            <th scope="row">{i + 1}</th>
            <td>{user.name && user.name}</td>
            <td>{user.nickname && user.nickname}</td>
            <td>{user.email && user.email}</td>
            <td>{user.age && user.age}</td>
            <td>{user.description && user.description}</td>
            <td>{user.platform && user.platform}</td>
            <td>{user.verified ? "Yes" : "No"}</td>
            <td>{user.user_filled_info ? "Yes" : "No"}</td>
            <td>{user.location_string && user.location_string}</td>
            <td>{user.created_at && user.created_at}</td>
            <td>
                <button
                    type="button"
                    onClick={() => handleUserBlock(user.id)}
                    className="btn blue-btn"
                >
                    {user.blocked ? "Unblock" : "Block"}
                </button>
            </td>
        </tr>
    );
};

export default UserRow;
