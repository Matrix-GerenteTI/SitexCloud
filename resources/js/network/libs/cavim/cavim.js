import { Api } from "../../api";
import { ApiPdf } from "../../api";
import { ApiExcel } from "../../api";

export const borrarRegistro = (folio) => {
    return Api.post("borrarRegistro/"+folio);
}

export const registrar = (data) => {
    return Api.post("registrar", data);
}

export const exportarExcel = (data) => {
    return ApiPdf.get("exportarExcel/"+data);
}

export const existsTicketRegister = (id) => {
    return Api.get("existsTicketRegister/"+id);
}

export const guardarVehiculo = (data) => {
    return Api.post("guardarVehiculo", data);
}

export const getChoferes = () => {
    return Api.get("getChoferes");
}

export const saveBonoChofer = (data) => {
    return Api.post("saveBonoChofer", data);
}

export const uploadFotoBono = (data) => {
    return Api.post("uploadFotoBono", data);
}

export const getBonosChoferesFiltros = (data) => {
    return Api.post("getBonosChoferesFiltros", data);
}

export const exportarExcelBonoChoferes = (data) => {
    return ApiExcel.post("exportarExcelBonoChoferes", data);
};

