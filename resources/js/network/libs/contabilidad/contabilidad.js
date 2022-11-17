import { Api } from "../../api";
import { ApiExcel } from "../../api";

export const uploadPhotosActivos = (data) => {
    return Api.post("uploadPhotosActivos", data);
};

export const saveActivoFijo = (data) => {
    return Api.post("saveActivoFijo", data);
};

export const getActivosFijos = () => {
    return Api.get("getActivosFijos");
};

export const borrarActivo = (id, data) => {
    return Api.post("borrarActivo/"+id, data);
};

export const exportarExcelActivos = (data) => {
    return ApiExcel.post("exportarExcelActivos", data);
};

export const getFiltroActivos = (data) => {
    return Api.post("getFiltroActivos", data);
};