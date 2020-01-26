import React, { useState } from "react";

const UserSearchBox = ({ getUserByQuery }) => {
    const [query, setQuery] = useState("");

    return (
        <div className="user-search-box__container">
            {query && <p>{`Find by query: ${query}`}</p>}
            <form
                onSubmit={e => {
                    e.preventDefault();
                    getUserByQuery(query);
                }}
            >
                <div className="form-group">
                    <input
                        type="string"
                        className="form-control"
                        id="query"
                        placeholder="Find user by nickname or email..."
                        onChange={e => setQuery(e.target.value)}
                    />
                </div>
                <button
                    type="button"
                    onClick={() => getUserByQuery(query)}
                    className="btn blue-btn"
                >
                    Search
                </button>
            </form>
        </div>
    );
};

export default UserSearchBox;
