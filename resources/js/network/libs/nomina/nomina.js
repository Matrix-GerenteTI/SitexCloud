import { Api } from "../../api";
import { ApiPdf } from "../../api";

export const registerParametros = (parametros) => {
    return Api.post("registerParametros", parametros);
};

export const agregarEmpleado = (empleado) => {
    return Api.post("agregarEmpleado", empleado);
};

export const editEmpleado = (nip) => {
    return Api.get("editEmpleado/"+nip);
};

export const editDireccion = (nip) => {
    return Api.get("editDireccion/"+nip);
};

export const editUsuario = (nip) => {
    return Api.get("editUsuario/"+nip);
};

export const editContrato = (nip) => {
    return Api.get("editContrato/"+nip);
};

export const editFotoEmpleado = (nip) => {
    return Api.get("editFotoEmpleado/"+nip);
};

export const updateEmpleado = (nip, empleado) => {
    return Api.post("updateEmpleado/"+nip+"", empleado);
}

export const changeAdscripcion = (adscripcion) => {
    return Api.post("changeAdscripcion", adscripcion);
};

export const renovarContrato = (data) => {
    return Api.post("renovarContrato", data);
};

export const bajaEmpleado = (nip) => {
    return Api.post("bajaEmpleado/"+nip);
}

export const generatePDFcontrato = (data) => {
    return ApiPdf.post("generatePDFcontrato", data);
};

export const uploadPhoto = (data) => {
    return Api.post("uploadPhoto", data);
};