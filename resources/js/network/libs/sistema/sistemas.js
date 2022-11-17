import { Api } from "../../api";

export const registrarPermiso = (data) => {
    return Api.post("registrarPermiso", data);
};

export const guardarExcepcion = (data) => {
    return Api.post("guardarExcepcion", data);
};

export const getRegistrosExcepciones = (idAlmacen) => {
    return Api.get("getRegistrosExcepciones/"+idAlmacen);
};

export const saveUsuarioSucursal = (data) => {
    return Api.post("saveUsuarioSucursal", data);
};

export const saveUsuarioIncidencia = (data) => {
    return Api.post("saveUsuarioIncidencia", data);
};

export const deleteUsuarioSucursal = (id) => {
    return Api.get("deleteUsuarioSucursal/"+id);
};

export const updateUsuarioSucursal = (data) => {
    return Api.post("updateUsuarioSucursal", data);
};
