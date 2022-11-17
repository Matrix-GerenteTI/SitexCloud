import { Api } from "../../api";

export const getUser = () => {
    return Api.get("user");
};
