import axios from "axios";

export const Api = axios.create({
    baseURL: "http://186.96.33.206:8080/matrix/public/",
    //baseURL: "http://sitex.matrix.com.mx/",
});

export const ApiPdf = axios.create({
    baseURL: "http://186.96.33.206:8080/matrix/public/",
    //baseURL: "http://sitex.matrix.com.mx/",
    method: 'POST',
    responseType: 'blob', // important
});

export const ApiExcel = axios.create({
    baseURL: "http://186.96.33.206:8080/matrix/public/",
    method: 'GET',
    responseType: 'blob', // important
});




