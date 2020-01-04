import React, { Component } from "react";
import { LoginProps, LoginState } from "./Login.interface";

class Login extends Component<LoginProps, LoginState> {
    constructor(props: LoginProps) {
        super(props);

        this.state = {};
    }

    render() {
        return <div>login</div>;
    }
}

export default Login;
