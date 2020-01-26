import React, { useState } from "react";

const AddCategory = ({ handleAddNewTranslation }) => {
    const [name, setName] = useState("");

    return (
        <div className="user-search-box__container">
            <form
                onSubmit={e => {
                    e.preventDefault();
                    handleAddNewTranslation(name);
                }}
            >
                <div className="form-group">
                    <input
                        type="string"
                        className="form-control"
                        id="name"
                        placeholder="Translation Name..."
                        onChange={e => setName(e.target.value)}
                    />
                </div>
                <button
                    type="button"
                    onClick={() => handleAddNewTranslation(name)}
                    className="btn blue-btn"
                >
                    Add New Translation
                </button>
            </form>
        </div>
    );
};

export default AddCategory;
