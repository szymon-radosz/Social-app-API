import React, { useState } from "react";

const AddCategory = ({ addNewCategory }) => {
    const [name, setName] = useState("");

    return (
        <div className="user-search-box__container">
            <form onSubmit={() => addNewCategory(name)}>
                <div className="form-group">
                    <input
                        type="string"
                        className="form-control"
                        id="name"
                        placeholder="Category Name..."
                        onChange={e => setName(e.target.value)}
                    />
                </div>
                <button
                    type="button"
                    onClick={() => addNewCategory(name)}
                    className="btn blue-btn"
                >
                    Add New Category
                </button>
            </form>
        </div>
    );
};

export default AddCategory;
