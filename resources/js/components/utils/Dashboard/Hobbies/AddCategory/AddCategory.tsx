import React, { useState } from "react";

const AddCategory = ({ handleAddNewHobby }) => {
    const [name, setName] = useState("");

    return (
        <div className="user-search-box__container">
            <form
                onSubmit={e => {
                    e.preventDefault();
                    handleAddNewHobby(name);
                }}
            >
                <div className="form-group">
                    <input
                        type="string"
                        className="form-control"
                        id="name"
                        placeholder="Hobby Name..."
                        onChange={e => setName(e.target.value)}
                    />
                </div>
                <button
                    type="button"
                    onClick={() => handleAddNewHobby(name)}
                    className="btn blue-btn"
                >
                    Add New Hobby
                </button>
            </form>
        </div>
    );
};

export default AddCategory;
