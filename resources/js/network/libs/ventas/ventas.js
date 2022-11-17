import { Api } from "../../api";

export const getTicketsFacturacion = (data) => {
    return Api.post("getTicketsFacturacion", data);
};

export const getTicketAnticipo = (id) => {
    return Api.get("getTicketAnticipo/"+id);
};
