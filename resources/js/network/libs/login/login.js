import { Api } from "../../api";

export const login = (form) => {
    return Api.post("login", form);
};

export const logout = () => {
    return Api.post("logout");
};
