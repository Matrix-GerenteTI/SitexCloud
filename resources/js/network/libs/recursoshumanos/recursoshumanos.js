import { Api } from "../../api";
import { ApiPdf } from "../../api";

export const getNivelquizz = () => {
    return Api.get("getNivelquizz");
}

export const getClasificacionquizz = () => {
    return Api.get("getClasificacionquizz");
}

export const getSubcategoriaquizz = () => {
    return Api.get("getSubcategoriaquizz");
}

export const saveQuizzPregunta = (data) => {
    return Api.post("saveQuizzPregunta", data);
};

export const saveQuizzRespuestas = (data) => {
    return Api.post("saveQuizzRespuestas", data);
};

export const uploadPhotosQuizz = (data) => {
    return Api.post("uploadFotos", data);
};

export const getTipoIncidencia = () => {
    return Api.get("getTipoIncidencia");
}

export const getAccionIncidencias = (idTipo) => {
    return Api.get("getAccionIncidencias/"+idTipo);
}

export const getAccionIncidenciasPorUsuario = (data) => {
    return Api.post("getAccionIncidenciasPorUsuario", data);
}

export const guardarIncidencia = (data) => {
    return Api.post("guardarIncidencia", data);
}

export const borrarIncidencia = (id) => {
    return Api.post("borrarIncidencia/"+id);
}

export const getAllDeducciones = () => {
    return Api.get("getAllDeducciones"); 
}

export const getAllPercepciones = () => {
    return Api.get("getAllPercepciones");
}

export const getPagos = (id) => {
    return Api.get("getPagos/"+id);
}

export const getDeduccionesEmpleado = () => {
    return Api.get("getDeduccionesEmpleado"); 
}

export const getPercepcionesEmpleado = () => {
    return Api.get("getPercepcionesEmpleado");
}

export const getPreguntasfiltrosQuizz = (data) => {
    return Api.post("getPreguntasfiltrosQuizz", data);
}

export const verRespuestasQuizz = (id) => {
    return Api.get("verRespuestasQuizz/"+id);
}

export const saveResguardo = (data) => {
    return Api.post("saveResguardo", data);
}

export const uploadPhotosResguardos = (data) => {
    return Api.post("uploadPhotosResguardos", data);
}

export const getResguardos = (id) => {
    return Api.get("getResguardos/"+id);
}

export const borrarResguardo = (id) => {
    return Api.get("borrarResguardo/"+id);
}

export const imprimirResguardo = (data) => {
    return ApiPdf.post("imprimirResguardo", data);
};

export const verFotosResguardos = (id) => {
    return Api.get("verFotosResguardos/"+id);
}