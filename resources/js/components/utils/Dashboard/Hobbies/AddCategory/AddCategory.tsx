import React, { useState } from "react";

const AddCategory = ({ addNewHobby }) => {
    const [name, setName] = useState("");

    return (
        <div className="user-search-box__container">
            <form onSubmit={() => addNewHobby(name)}>
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
                    onClick={() => addNewHobby(name)}
                    className="btn blue-btn"
                >
                    Add New Hobby
                </button>
            </form>
        </div>
    );
};

export default AddCategory;
