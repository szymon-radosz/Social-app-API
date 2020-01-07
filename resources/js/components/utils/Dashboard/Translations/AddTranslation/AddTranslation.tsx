import React, { useState } from "react";

const AddCategory = ({ addNewTranslation }) => {
    const [name, setName] = useState("");

    return (
        <div className="user-search-box__container">
            <form
                onSubmit={e => {
                    e.preventDefault();
                    addNewTranslation(name);
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
                    onClick={() => addNewTranslation(name)}
                    className="btn blue-btn"
                >
                    Add New Translation
                </button>
            </form>
        </div>
    );
};

export default AddCategory;
