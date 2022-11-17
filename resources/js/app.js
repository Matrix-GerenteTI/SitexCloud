require('./bootstrap');

window.Vue = require('vue');

Vue.component("login-view", require("./views/login/index.vue").default);
Vue.component("dashboard-view", require("./views/users/dashboard.vue").default);
Vue.component("sgc-recursos-view", require("./views/users/SGC/recursos.vue").default);
Vue.component("nomina-parametros-view", require("./views/users/nomina/parametros.vue").default);
Vue.component("nomina-empleados-view", require("./views/users/nomina/Empleados.vue").default);
Vue.component("cavim-vehiculo-view", require("./views/users/cavim/registroVehiculos.vue").default);
Vue.component("contabilidad-activosfijos-view", require("./views/users/contabilidad/activos_fijos.vue").default);
Vue.component("almacen-politicaprecios-view", require("./views/users/almacen/politicaprecios.vue").default);
Vue.component("ti-excepciones-view", require("./views/users/ti/excepciones.vue").default);
Vue.component("ti-usuariosucursal-view", require("./views/users/ti/usuarioSucursal.vue").default);
Vue.component("ti-usuarioincidencia-view", require("./views/users/ti/usuarioIncidencia.vue").default);
Vue.component("cavim-newvehiculo-view", require("./views/users/cavim/nuevoVehiculo.vue").default);
Vue.component("cavim-bonochoferes-view", require("./views/users/cavim/bonoChoferes.vue").default);
Vue.component("compras-proveedor-view", require("./views/users/compras/comprasproveedor.vue").default);
Vue.component("rh-quizz-view", require("./views/users/recursoshumanos/quizz.vue").default);
Vue.component("rh-incidencias-view", require("./views/users/recursoshumanos/incidencias.vue").default);
Vue.component("rh-resguardos-view", require("./views/users/recursoshumanos/resguardos.vue").default);
Vue.component("ventas-facturacion-view", require("./views/users/ventas/facturacion.vue").default);
Vue.component("ventas-pedido-view", require("./views/users/ventas/pedido.vue").default);

const app = new Vue({
    el: '#app',
});
