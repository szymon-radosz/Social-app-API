import React from "react";
import ForumCategoryRow from "./ForumCategoryRow/ForumCategoryRow";
import TableLegend from "./../../utils/TableLegend";

const legends = [
    {
        text: "Blocked Forum Categories",
        color: "#ffd4d8"
    }
];

const ForumCategoryList = ({
    categories,
    handleCategoryChangeName,
    handleCategoryBlock
}) => {
    return (
        <>
            <div className="table-responsive">
                <table className="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Update</th>
                            <th scope="col">Blocked</th>
                        </tr>
                    </thead>
                    <tbody>
                        {categories &&
                            categories.map((category, i) => {
                                return (
                                    <ForumCategoryRow
                                        key={i}
                                        category={category}
                                        i={i}
                                        handleCategoryChangeName={
                                            handleCategoryChangeName
                                        }
                                        handleCategoryBlock={
                                            handleCategoryBlock
                                        }
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

export default ForumCategoryList;
