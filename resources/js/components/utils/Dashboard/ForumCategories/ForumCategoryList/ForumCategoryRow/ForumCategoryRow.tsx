import React, { useState } from "react";

const ForumCategoryRow = ({
    category,
    i,
    handleCategoryChangeName,
    handleCategoryBlock
}) => {
    const [name, setName] = useState(category.name);

    return (
        <tr className={category.blocked && "danger-row"}>
            <th scope="row">{i + 1}</th>
            <td>
                <div className="form-group">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Category name"
                        value={name}
                        onChange={e => setName(e.target.value)}
                    />
                </div>
            </td>
            <td>{category.created_at && category.created_at}</td>
            <td>
                <button
                    type="button"
                    onClick={() => handleCategoryChangeName(category.id, name)}
                    className="btn blue-btn"
                >
                    Update
                </button>
            </td>
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
