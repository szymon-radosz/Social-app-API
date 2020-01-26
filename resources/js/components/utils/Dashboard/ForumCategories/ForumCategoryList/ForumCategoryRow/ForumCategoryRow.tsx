import React from "react";

const ForumCategoryRow = ({ category, i, handleCategoryBlock }) => {
    return (
        <tr
            className={
                category.blocked ? "danger-row category__row" : "category__row"
            }
        >
            <th scope="row">{i + 1}</th>
            <td>{category.name}</td>
            <td>{category.created_at && category.created_at}</td>
            <td>
                <button
                    type="button"
                    onClick={() => handleCategoryBlock(category.id)}
                    className="btn blue-btn"
                >
                    {category.blocked ? "Unblock" : "Block"}
                </button>
            </td>
        </tr>
    );
};

export default ForumCategoryRow;
