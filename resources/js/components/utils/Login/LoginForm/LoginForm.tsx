import React, { useState } from "react";

const LoginForm = ({ onLoginSubmit }) => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    return (
        <form
            className="login-form"
            onSubmit={() => onLoginSubmit(email, password)}
        >
            <img src="/images/logo-sq.png" />
            <div className="form-group">
                <input
                    type="email"
                    className="form-control"
                    placeholder="Email"
                    onChange={e => setEmail(e.target.value)}
                />
            </div>
            <div className="form-group">
                <input
                    type="password"
                    className="form-control"
                    placeholder="Password"
                    onChange={e => setPassword(e.target.value)}
                />
            </div>
            <button
                type="submit"
                onClick={() => onLoginSubmit(email, password)}
                className="btn blue-btn"
            >
                Login
            </button>
        </form>
    );
};
export default LoginForm;