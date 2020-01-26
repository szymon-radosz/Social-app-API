import React, { useState } from "react";

const RegisterForm = ({ handleRegisterUser }) => {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    return (
        <div className="user-search-box__container">
            <form
                onSubmit={e => {
                    e.preventDefault();
                    handleRegisterUser(name, email, password);
                }}
            >
                <div className="form-group">
                    <input
                        type="string"
                        className="form-control"
                        id="name"
                        placeholder="Name..."
                        onChange={e => setName(e.target.value)}
                    />
                </div>
                <div className="form-group">
                    <input
                        type="email"
                        className="form-control"
                        id="email"
                        placeholder="Email..."
                        onChange={e => setEmail(e.target.value)}
                    />
                </div>
                <div className="form-group">
                    <input
                        type="string"
                        className="form-control"
                        id="password"
                        placeholder="Password..."
                        onChange={e => setPassword(e.target.value)}
                    />
                </div>
                <button
                    type="button"
                    onClick={() => handleRegisterUser(name, email, password)}
                    className="btn blue-btn"
                >
                    Add New Admin
                </button>
            </form>
        </div>
    );
};

export default RegisterForm;
