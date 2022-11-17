import { Api } from "../../api";

export const getSucursal = () => {
    return Api.get("getSucursal");
};

export const getDepartamento = () => {
    return Api.get("getDepartamento");
};

export const getPuesto = (id) => {
    return Api.get("getPuesto/"+id);
};

export const getEmpleado = (id) => {
    return Api.get("getEmpleado/"+id);
};

export const getEstadosRepublica = () => {
    return Api.get("getEstados");
};

export const getEstadoCivil = () => {
    return Api.get("getEstadoCivil");
};

export const getSexo = () => {
    return Api.get("getSexo");
};

export const getNivelEstudio = () => {
    return Api.get("getNivelEstudio");
};

export const getTipoSangre = () => {
    return Api.get("getTipoSangre");
};

export const getTipoUsuario = () => {
    return Api.get("getTipoUsuario");
};

export const getTipoContrato = () => {
    return Api.get("getTipoContrato");
};

export const getTiempoContrato = () => {
    return Api.get("getTiempoContrato");
};

export const getTipoJornada = () => {
    return Api.get("getTipoJornada");
};

export const getAntiguedad = (fechaInicioLaboral) => {
    return Api.get("getAntiguedad/"+fechaInicioLaboral);
};

export const getTipoRegimen = () => {
    return Api.get("getTipoRegimen");
};

export const getRiesgoPuesto = () => {
    return Api.get("getRiesgoPuesto");
};

export const getPeriodicidadPago = () => {
    return Api.get("getPeriodicidadPago");
};

export const getBancos = () => {
    return Api.get("getBancos");
};

export const getEmpleadosAll = () => {
    return Api.get("getEmpleadosAll");
};

export const getTipoDocumentos = () => {
    return Api.get("getTipoDocumentos");
};

export const getMarca = () => {
    return Api.get("getMarca");
};

export const getLinea = (marca) => {
    return Api.get("getLinea/"+marca);
};

export const getRegistrosCavim = (fecha) => {
    return Api.get("getRegistrosCavim/"+fecha);
};

export const getTicketsPrediction = (fecha) => {
    return Api.get("getTicketsPrediction/"+fecha);
};

export const getUsuarioPermiso = (puesto) => {
    return Api.get("getUsuarioPermiso/"+puesto);
};

export const getModulo = () => {
    return Api.get("getModulo");
};

export const getSubmodulo = (id) => {
    return Api.get("getSubmodulo/"+id);
};

export const getAccion = (id) => {
    return Api.get("getAccion/"+id);
};

export const getCategoria = () => {
    return Api.get("getCategoria");
};

export const getSubcategoria = (idCategoria) => {
    return Api.get("getSubcategoria/"+idCategoria);
};

export const getUsuarios = () => {
    return Api.get("getUsuarios");
};

export const getNameCliente = ($name) => {
    return Api.get("getNameCliente/"+$name);
};

export const getFormaPago = () => {
    return Api.get("getFormaPago");
};

export const getUsoCfdi = () => {
    return Api.get("getUsoCfdi");
};

export const getRegistrosUsuarioSucursal = (usuario) => {
    return Api.get("getRegistrosUsuarioSucursal/"+usuario);
};

export const getTipoVenta = () => {
    return Api.get("getTipoVenta");
};

export const getTipoTicket = () => {
    return Api.get("getTipoTicket");
};

export const searchEmpleado = (data) => {
    return Api.get("searchEmpleado/"+data);
};

export const getAllSubcategorias = () => {
    return Api.get("getAllSubcategorias");
};

