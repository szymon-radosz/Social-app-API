import React from "react";
import UserRow from "./UserRow/UserRow";
import TableLegend from "./../../utils/TableLegend";

const legends = [
    {
        text: "Blocked Users",
        color: "#ffd4d8"
    }
];

const UserList = ({ users, handleUserBlock }) => {
    return (
        <>
            <div className="table-responsive">
                <table className="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Nickname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Age</th>
                            <th scope="col">Description</th>
                            <th scope="col">Platform</th>
                            <th scope="col">Verified</th>
                            <th scope="col">Filled Info</th>
                            <th scope="col">Location</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Block User</th>
                        </tr>
                    </thead>
                    <tbody>
                        {users &&
                            users.map((user, i) => {
                                return (
                                    <UserRow
                                        key={i}
                                        user={user}
                                        i={i}
                                        handleUserBlock={handleUserBlock}
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

export default UserList;
