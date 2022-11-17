import { Api } from "../../api";
import { ApiExcel } from "../../api";

export const getFamilia = () => {
    return Api.get("getFamilia");
}

export const getSubfamilia = (data) => {
    return Api.get("getSubfamilia/"+data);
}

export const getAllPoliticaPrecios = () => {
    return Api.get("getAllPoliticaPrecios");
}

export const getPrecioPorFamilia = (data) => {
    return Api.get("getPrecioPorFamilia/"+data);
}

export const getPrecioPorSubfamilia = (data) => {
    return Api.post("getPrecioPorSubfamilia", data);
}

export const savePrecio = (data) => {
    return Api.post("savePrecio", data);
}

export const borrarPrecio = (id) => {
    return Api.post("borrarPrecio/"+id);
}

export const getAllSubfamilias = () => {
    return Api.get("getAllSubfamilias");
}

export const updateItemTabla = (data) => {
    return Api.post("updateItemTabla", data);
}

export const getFiltroFamilia = () => {
    return Api.get("getFiltroFamilia");
}

export const getFiltroSubfamilia = (data) => {
    return Api.get("getFiltroSubfamilia/"+data);
}

export const getllantas = () => {
    return Api.get("getllantas");
}

export const exportarExcelPoliticaPrecios = (data) => {
    return ApiExcel.post("exportarExcelPoliticaPrecios", data);
};