<template>
    <div style="max-height: 200px !important">
        <div id="overlay">
            <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                
            </div>
        </div>
        <div class="row my-4 mr-4 justify-content-end">
            <button class="btn btn-warning mr-2" type="button" data-toggle="modal" data-target="#exampleModalCenter" @click="getEmpleadosAll">
                <i class="fas fa-search" style="font-size: 30px"></i>
                <span class="row justify-content-md-center">Buscar</span>
            </button>
            <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Buscar Empleado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            Departamento<br/>
                                            <select id="inputDepartamento" class="form-control" v-model="departamentoSearch" @change="filtrarEmpleados">
                                                <option>TODOS</option>
                                                <option v-for="(item, index) in itemsDepartamento" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                            </select>
                                        </td>
                                        <td>
                                            Nombre del Trabajador<br/>
                                            <input type="text" id="idNameEmpleado" style="width:95%" v-model="nameEmpleado"/>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-dark" @click="buscarEmpleadoModal">
                                                <i class="fas fa-search" style="font-size: 15px"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                <br/>
                                <table class="table table-striped table-hover" data-dismiss="modal">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Trabajador</th>
                                            <th>Departamento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,i) in itemsAllEmpleados" :key="i">
                                            <td scope="row" @click="editEmpleado(item.nip)">{{ item.nombre  }}</td>
                                            <td @click="editEmpleado(item.nip)">{{ item.descripcion  }}</td>
                                            <!--<td>
                                                <div class="row justify-content-md-center">
                                                    <button class="btn btn-success" type="button" @click="editEmpleado(item.nip)">
                                                        <i class="fas fa-arrow-circle-right"></i>
                                                    </button>
                                                </div>
                                            </td>-->  
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!--Fin Modal Buscar Empleado-->
            <button v-if="this.value.nip == null" class="btn btn-success mr-2" type="button" @click="agregarEmpleado">
                <i class="fas fa-save" style="font-size: 30px"></i>
                <span class="row justify-content-md-center">Guardar</span>
            </button>
            <button v-if="this.value.nip != null" class="btn btn-success mr-2" type="button" @click="actualizarEmpleado">
                <i class="fas fa-user-edit" style="font-size: 30px"></i>
                <span class="row justify-content-md-center">Actualizar</span>
            </button>
            <button v-if="this.value.nip != null" class="btn btn-primary mr-2" type="button" @click="cleanInputs">
                <i class="fas fa-file" style="font-size: 30px"></i>
                <span class="row justify-content-md-center">Nuevo</span>
            </button>
            <button v-if="this.value.nip != null" class="btn btn-danger mr-2" type="button" @click="bajaEmpleado">
                <i class="fas fa-trash-alt" style="font-size: 30px"></i>
                <span class="row justify-content-md-center">Baja</span>
            </button>
        </div>
           
        <div class="row mx-2">
            <div class="col-md-12">
                <div class="card my-2">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Datos Personales</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                    <div class="custom-file">
                                        <div class="form-row justify-content-center">
                                            <img id="frameEmpleado" src="" class="rounded img-fluid" @click="subirFoto">
                                            <input type="file"  class="custom-file-input" id="takePhoto" style="display: none" @change="uploadImage">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="inputNIP">NIP</label>
                                            <input type="text" class="form-control" id="inputNIP" v-model="value.nip" placeholder="---" readonly style="text-align:center">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="inputNombre">Nombre</label>
                                            <input type="text" class="form-control text-uppercase" id="inputNombre" v-model="value.nombre">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputRFC">RFC</label>
                                            <input type="text" class="form-control text-uppercase" id="inputRFC" v-model="value.rfc">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCURP">CURP</label>
                                            <input type="text" class="form-control text-uppercase" id="inputCURP" v-model="value.curp">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputNSS">NSS</label>
                                            <input type="number" class="form-control" id="inputNSS" v-model="value.nss">
                                        </div>    
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputFechaNacimiento">Fecha de nacimiento</label>
                                        <input type="date" class="form-control" id="inputFechaNacimiento" @change="edadEmpleado" v-model="value.fechaNacimiento">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEdad">Edad</label>
                                        <input type="text" class="form-control" id="inputEdad" readonly v-model="value.edad">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEstadoCivil">Estado civil</label>
                                        <select id="inputEstadoCivil" class="form-control" v-model="value.estadoCivil">
                                            <option v-for="(item, index) in itemsEstadoCivil" :key="index">{{ item.descripcionEstadoCivil }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputSexo">Sexo</label>
                                        <select id="inputSexo" class="form-control" v-model="value.sexo">
                                            <option v-for="(item, index) in itemsSexo" :key="index">{{ item.descripcionSexo }}</option>
                                        </select>
                                    </div>   
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCalle">Calle</label>
                                    <input type="text" class="form-control text-uppercase" id="inputCalle" v-model="value.calle">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputNumExt">Núm. Ext.</label>
                                    <input type="text" class="form-control text-uppercase" id="inputNumExt" v-model="value.numExt">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputNumInt">Núm. Int.</label>
                                    <input type="text" class="form-control text-uppercase" id="inputNumInt" v-model="value.numInt">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputColonia">Colonia</label>
                                    <input type="text" class="form-control text-uppercase" id="inputColonia" v-model="value.colonia">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputCP">C.P.</label>
                                    <input type="number" class="form-control" id="inputCP" v-model="value.cp">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEstado">Estado</label>
                                    <select id="inputEstado" class="form-control" v-model="value.estado">
                                        <option v-for="(item, index) in itemsEstados" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputMunicipio">Municipio</label>
                                    <input type="text" class="form-control text-uppercase" id="inputMunicipio" v-model="value.municipio">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail">Correo Electrónico</label>
                                    <input type="email" class="form-control text-uppercase" id="inputEmail" v-model="value.email" placeholder="example@example.com">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputTelefonoCelular">Telefono Celular</label>
                                    <input type="number" class="form-control" id="inputTelefonoCelular" v-model="value.telefonoCelular">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputTelefonoFijo">Telefono Fijo</label>
                                    <input type="number" class="form-control" id="inputTelefonoFijo" v-model="value.telefonoFijo">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputReligion">Religión</label>
                                    <input type="text" class="form-control text-uppercase" id="inputReligion" v-model="value.religion">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputHijos">¿Tiene hijos?</label>
                                    <div class="form-row justify-content-md-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadio" id="inputHijosSI" value="SI" v-model="value.hijos" data-toggle="modal" data-target=".bd-example-modal-sm">
                                            <label class="form-check-label" for="inputHijosSI">SI</label>
                                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card bg-light mb-3 my-3">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title font-weight-bold">Numero de Hijos</h5>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="form-row justify-content-md-center">
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="inputNumHijas"># Hijas</label>
                                                                                    <input type="number" class="form-control" id="inputNumHijas" v-model="numHijas">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="inputNumHijos"># Hijos</label>
                                                                                    <input type="number" class="form-control" id="inputNumHijos" v-model="numHijos">
                                                                                </div>    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadio" id="inputHijosNO" value="NO" v-model="value.hijos"> 
                                            <label class="form-check-label" for="inputHijosNO">NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputEscolaridad">Escolaridad</label>
                                    <select id="inputEscolaridad" class="form-control" v-model="value.escolaridad">
                                        <option v-for="(item, index) in itemsEscolaridad" :key="index">{{ item.descripcionEscolaridad }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputAsegurado">¿Asegurado?</label>
                                    <div class="form-row justify-content-md-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inputAseguradoSI" value="s" v-model="value.asegurado">
                                            <label class="form-check-label" for="inputAseguradoSI">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inputAseguradoNO" value="n" v-model="value.asegurado">
                                            <label class="form-check-label" for="inputAseguradoNO">NO</label>
                                        </div>
                                        </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputSangre">Tipo de Sangre</label>
                                    <select id="inputSangre" class="form-control" v-model="value.tipoSangre">
                                        <option v-for="(item, index) in itemsTipoSangre" :key="index">{{ item.descripcionSangre }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputAlergias">Alergias Medicas</label>
                                    <input type="text" class="form-control text-uppercase" id="inputAlergias" v-model="value.alergias">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-2">
            <div class="col-md-12">
                <div class="card my-2">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Datos de Acceso</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputUsuario">Usuario</label>
                                    <input type="text" class="form-control text-uppercase" id="inputUsuario" v-model="value.username">
                                </div>
                                <div class="form-group col-md-3">
                                <label for="inputContraseña">Contraseña</label>
                                    <div class="input-group">
                                    <input type="password" class="form-control" id="inputContraseña" v-model="value.password">
                                        <div class="input-group-append">
                                            <button id="show_password" class="btn btn-primary" type="button" @click="mostrarPassword">
                                            <span class="fas fa-eye-slash icon"></span> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                <label for="inputConfirmarContraseña">Confirmar Contraseña</label>
                                    <div class="input-group">
                                    <input type="password" class="form-control" id="inputConfirmarContraseña" v-model="value.confirmarPassword"> 
                                        <div class="input-group-append">
                                            <button id="show_confirmpassword" class="btn btn-primary" type="button" @click="mostrarPassword">
                                            <span class="fas fa-eye-slash icon"></span> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputTipoUsuario">Tipo de Usuario</label>
                                    <select id="inputTipoUsuario" class="form-control" v-model="value.tipoUsuario">
                                         <option v-for="(item, index) in itemsTipoUsuario" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-2">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Datos del Contrato</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputSucursal">Sucursal</label>
                                    <select id="inputSucursal" class="form-control" v-model="value.sucursal">
                                        <option v-for="(item, index) in itemsSucursal" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDepartamento">Departamento</label>
                                    <select id="inputDepartamento" class="form-control" v-model="value.departamento" @change="getPuesto">
                                        <option v-for="(item, index) in itemsDepartamento" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPuesto">Puesto</label>
                                    <select id="inputPuesto" class="form-control" v-model="value.puesto">
                                        <option v-for="(item, index) in itemsPuesto" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputAdscripcion">Adscripción</label>
                                    <div class="form-row justify-content-md-center">
                                        <button type="button" class="btn btn-danger" :disabled="button" data-toggle="modal" data-target="#ModalCambioAdscripcion">Cambiar</button>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="ModalCambioAdscripcion" tabindex="-1" role="dialog" aria-labelledby="ModalCambioAdscripcionTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="ModalCambioAdscripcionTitle">Adcripcion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row justify-content-md-center">
                                                            <div class="form-group">
                                                                <label for="inputFechaCambio">Fecha de Cambio</label>
                                                                <input type="date" class="form-control" id="inputFechaCambio" v-model="adscripcion.fechaCambio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-success" data-dismiss="modal" @click="changeAdscripcion">Confirmar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!--Fin Modal Buscar Empleado-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputTipoContrato">Tipo de Contrato</label>
                                    <select id="inputTipoContrato" class="form-control" v-model="value.tipoContrato">
                                        <option v-for="(item, index) in itemsTipoContrato" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputTiempoContrato">Tiempo de Contrato</label>
                                    <select id="inputTiempoContrato" class="form-control" v-model="value.tiempoContrato">
                                        <option v-for="(item, index) in itemsTiempoContrato" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputTipoJornada">Tipo de Jornada</label>
                                    <select id="inputTipoJornada" class="form-control" v-model="value.tipoJornada">
                                        <option v-for="(item, index) in itemsTipoJornada" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputFechaInicioLaboral">Fecha de Inicio Laboral</label>
                                    <input type="date" class="form-control" id="inputFechaInicioLaboral" v-model="value.fechaInicioLaboral" @change="getAntiguedad">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputAntiguedad">Antiguedad</label>
                                    <input type="text" class="form-control" id="inputAntiguedad" readonly v-model="value.antiguedad">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputSindicalizado">¿Sindicalizado?</label>
                                    <div class="form-row justify-content-md-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inputSindicalizadoSI" value="Si" v-model="value.sindicalizado">
                                            <label class="form-check-label" for="inputSindicalizadoSI">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inputSindicalizadoNO" value="No" v-model="value.sindicalizado">
                                            <label class="form-check-label" for="inputSindicalizadoNO">NO</label>
                                        </div>
                                        </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputTipoRegimen">Tipo de Regimen</label>
                                    <select id="inputTipoRegimen" class="form-control" v-model="value.tipoRegimen">
                                        <option v-for="(item, index) in itemsTipoRegimen" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputRiesgo">Riesgo del Puesto</label>
                                    <select id="inputRiesgo" class="form-control" v-model="value.riesgoPuesto">
                                        <option v-for="(item, index) in itemsRiesgoPuesto" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputPeriodicidad">Periodicidad de Pago</label>
                                    <select id="inputPeriodicidad" class="form-control" v-model="value.periodicidadPago">
                                        <option v-for="(item, index) in itemsPeriodicidadPago" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputSalarioBase">Salario Base</label>
                                    <input type="number" class="form-control" id="inputSalarioBase" v-model="value.salarioBase">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputSalarioDiario">Salario Diario Integrado</label>
                                    <input type="number" class="form-control" id="inputSalarioDiario" v-model="value.salarioDiario">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputBanco">Banco</label>
                                    <select id="inputBanco" class="form-control" v-model="value.bancos">
                                        <option v-for="(item, index) in itemsBancos" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCuentaBancaria">Cuenta Bancaria</label>
                                    <input type="number" class="form-control" id="inputCuentaBancaria" v-model="value.cuentaBancaria">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputRFCSubcontratacion">RFC (Subcontratación)</label>
                                    <input type="text" class="form-control text-uppercase" id="inputRFCSubcontratacion" v-model="value.subRfc">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputTiempo">% de Tiempo (Subcontratación)</label>
                                    <input type="number" class="form-control" id="inputTiempo" v-model="value.subPorcentaje">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputAcciones"></label>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-row justify-content-md-center">
                                                <button type="button" class="btn btn-primary" :disabled="button" @click="generatePDFcontrato">Imprimir Contrato
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-row justify-content-md-center">
                                                <button type="button" class="btn btn-success" :disabled="button" @click="renovarContrato">Renovar Contrato</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-2">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Documentación Digital</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                 <div class="form-group col-md-5">
                                    <div class="custom-file">
                                        <label class="form-label" for="customFile">Subir Archivos</label>
                                        <input type="file" class="form-control" id="customFile">
                                    </div>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="inputTipoDocumento">Tipo de Documento</label>
                                    <select id="inputTipoDocumento" class="form-control" v-model="tipoDocumentos">
                                        <option v-for="(item, index) in itemsTipoDocumentos" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 align-self-end">
                                    <div class="form-row justify-content-md-center">
                                        <button type="button" class="btn btn-primary" :disabled="button">Agregar Archivo</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import { getEstadosRepublica } from "../../../network/libs/gets/gets.js";
import { getEstadoCivil } from "../../../network/libs/gets/gets.js";
import { getSexo } from "../../../network/libs/gets/gets.js";
import { getNivelEstudio } from "../../../network/libs/gets/gets.js";
import { getTipoSangre } from "../../../network/libs/gets/gets.js";
import { getTipoUsuario } from "../../../network/libs/gets/gets.js";
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getDepartamento } from "../../../network/libs/gets/gets.js";
import { getPuesto } from "../../../network/libs/gets/gets.js";
import { getTipoContrato } from "../../../network/libs/gets/gets.js";
import { getTiempoContrato } from "../../../network/libs/gets/gets.js";
import { getTipoJornada } from "../../../network/libs/gets/gets.js";
import { getAntiguedad } from "../../../network/libs/gets/gets.js";
import { getTipoRegimen } from "../../../network/libs/gets/gets.js";
import { getRiesgoPuesto } from "../../../network/libs/gets/gets.js";
import { getPeriodicidadPago } from "../../../network/libs/gets/gets.js";
import { getBancos } from "../../../network/libs/gets/gets.js";
import { getEmpleadosAll } from "../../../network/libs/gets/gets.js";
import { getTipoDocumentos } from "../../../network/libs/gets/gets.js";


import { agregarEmpleado } from "../../../network/libs/nomina/nomina.js";
import { editEmpleado } from "../../../network/libs/nomina/nomina.js";
import { editDireccion } from "../../../network/libs/nomina/nomina.js";
import { editUsuario } from "../../../network/libs/nomina/nomina.js";
import { editContrato } from "../../../network/libs/nomina/nomina.js";
import { editFotoEmpleado } from "../../../network/libs/nomina/nomina.js";
import { updateEmpleado } from "../../../network/libs/nomina/nomina.js";
import { changeAdscripcion } from "../../../network/libs/nomina/nomina.js";
import { renovarContrato } from "../../../network/libs/nomina/nomina.js";
import { bajaEmpleado } from "../../../network/libs/nomina/nomina.js";
import { generatePDFcontrato } from "../../../network/libs/nomina/nomina.js";
import { uploadPhoto } from "../../../network/libs/nomina/nomina.js";


export default {
  data() {
    return {
        button: true,
        itemsEstados:[],
        itemsSexo: [],
        itemsEstadoCivil: [],
        itemsEscolaridad: [],
        itemsTipoSangre: [],
        itemsTipoUsuario: [],
        itemsSucursal: [],
        itemsDepartamento: [],
        itemsPuesto: [],
        itemsTipoContrato: [],
        itemsTiempoContrato: [],
        itemsTipoJornada: [],
        itemsTipoRegimen:[],
        itemsRiesgoPuesto: [],
        itemsPeriodicidadPago:[],
        itemsBancos:[],
        itemsAllEmpleados: [],
        itemsFiltroAllEmpleados: [],
        itemsTipoDocumentos: [],
        nameEmpleado: '',
        numHijos: 0,
        numHijas: 0,
        departamentoSearch:'TODOS',
        tipoDocumentos: '',
        value: {
            nip: null,
            nombre: '',
            rfc: '',
            curp: '',
            nss: '',
            fechaNacimiento: null,
            edad: 0,
            estadoCivil: '',
            sexo: '',
            calle: '',
            numExt: '',
            numInt: '',
            colonia: '',
            cp: 0,
            estado: '',
            municipio: '',
            email: '',
            telefonoCelular: 0,
            telefonoFijo: 0,
            religion: '',
            hijos: null,
            escolaridad: '',
            asegurado: null,
            tipoSangre: '',
            alergias: '',
            username: '',
            password: '',
            confirmarPassword: '',
            tipoUsuario: '',
            departamento: 0,
            puesto: 0,
            sucursal: 0,
            tipoContrato: 0,
            tiempoContrato: 0,
            tipoJornada: 0,
            fechaInicioLaboral: null,
            antiguedad: '',
            tipoRegimen: 0,
            riesgoPuesto: 0,
            periodicidadPago: 0,
            bancos: 0,
            sindicalizado: '',
            salarioBase: 0,
            salarioDiario: 0,
            cuentaBancaria: 0,
            subRfc: '',
            subPorcentaje: 0,
        },
        adscripcion: {
            sucursalSalida: 0,
            sucursalLlegada: 0,
            idPuesto: 0,
            fechaCambio: null,
            idEmpleado: 0,
            tipoMovimiento: '',
            sueldo: 0
        },
        pdf: {
            empleado: '',
            fecha: null,
            puesto: '',
            sexo: '',
            edad: '',
            edocivil: '',
            rfc: '',
            curp: '',
            domicilio: '',
            estado: ''
        }
    };
    },
    mounted() {
      this.getItems();   
      this.cleanInputs();  
  },
  methods: {
      async uploadImage()
      {
        let input = document.getElementById('takePhoto');
        let foto = input.files[0]
        let data = new FormData();
        data.append("foto", foto);
		data.append('nip', this.value.nip);

        await uploadPhoto(data).then((response) => {
            console.log(response)
            if(response.data == true )
            {
                Swal.fire({
                icon: 'success',
                title: 'Imagen Registrada!',
                text: 'La foto del empleado ha sido almacenada exitosamente',
                showConfirmButton: false,
                timer: 3000
                })
                frameEmpleado.src=URL.createObjectURL(foto);
            }
            else
                alert("Imagen error")
        })
        .catch((err) => {
            switch (err.response.status)
            {
                case 422: 
                    Swal.fire({
                    icon: 'error',
                    title: 'Archivo Erroneo',
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
      },
    subirFoto()
    {
        if(this.value.nip == null)
            alert("Debes buscar un empleado")
        else
        {
            $("#takePhoto").click();
        }
    },
    agregarEmpleado()
    {
        this.value.hijos = this.numHijas+"-"+this.numHijos;
        if(this.value.password == this.value.confirmarPassword){
            agregarEmpleado(this.value).then((res) => {
            if(res.data == true){
                Swal.fire({
                icon: 'success',
                title: '¡Empleado Registrado!',
                showConfirmButton: false,
                timer: 2500
                })
            this.cleanInputs()
            }
            else{
                Swal.fire({
                icon: 'error',
                title: res.data,
                showConfirmButton: false,
                timer: 2500
                })
            }
        })
        .catch((err) => {
            alert(err.response.status) 
        });
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Las contraseñas ingresadas no coinciden',
                showConfirmButton: false,
                timer: 2500
                })
        }
    },
    buscarEmpleadoModal()
    {   
        this.filtrarEmpleados()
        let insertItems = []
        var name = this.nameEmpleado
        var cadena = new RegExp(name, "i")
        for (let i=0; i<this.itemsAllEmpleados.length; i++)
        {
            if(this.itemsAllEmpleados[i].nombre.match(cadena))
            {
                insertItems.push(this.itemsAllEmpleados[i]) 
            }
        }
        this.itemsAllEmpleados = insertItems
    },
    async changeAdscripcion()
    {
        this.adscripcion.sucursalLlegada = this.value.sucursal
        this.adscripcion.idPuesto = this.value.puesto
        this.adscripcion.idEmpleado = this.value.nip
        this.adscripcion.tipoMovimiento = 'cambioAdscrip'
        this.adscripcion.sueldo = this.value.salarioBase
        console.log(this.adscripcion)
        await changeAdscripcion(this.adscripcion).then((res) => {
            if(res.data == true){
                Swal.fire({
                icon: 'success',
                title: '¡Adscripción Actualizado!',
                text: 'Los cambios del trabajador se realizaron correctamente',
                showConfirmButton: false,
                timer: 2500
                })
            }
            else{
                Swal.fire({
                icon: 'error',
                title: res.data,
                showConfirmButton: false,
                timer: 2500
                })
            }
        })
        .catch((err) => {
            alert(err.response.status) 
        });
    },
    async editEmpleado(nip)
    {
        await editEmpleado(nip).then((response) => {
            let arrayEdit = response.data
            this.value.nip = arrayEdit.nip
            this.value.nombre = arrayEdit.nombre
            this.value.rfc = arrayEdit.rfc
            this.value.curp = arrayEdit.curp
            this.value.nss = arrayEdit.nss
            this.value.fechaNacimiento = arrayEdit.fechanac
            this.value.estadoCivil = arrayEdit.edocivil
            this.value.sexo = arrayEdit.sexo
            this.value.calle = ''
            this.value.numExt = ''
            this.value.numInt = ''
            this.value.colonia = ''
            this.value.cp = 0,
            this.value.estado = '',
            this.value.municipio = '',
            this.value.email = arrayEdit.email
            this.value.telefonoCelular = arrayEdit.celular
            this.value.telefonoFijo = arrayEdit.telefono
            this.value.religion = arrayEdit.religion
            this.value.escolaridad = arrayEdit.nivelestudios
            this.value.asegurado = arrayEdit.asegurado,
            this.value.tipoSangre = arrayEdit.tiposangre
            this.value.alergias = arrayEdit.alergias
            this.value.sucursal = arrayEdit.idsucursal
            this.adscripcion.sucursalSalida = arrayEdit.idsucursal
            this.edadEmpleado()
            this.editHijos(arrayEdit.numhijos)
            this.editDireccion(nip)
            this.button = false
            this.editUsuario(nip)
            this.editContrato(nip)
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await editFotoEmpleado(nip).then((response) => {
            var foto = document.getElementById("frameEmpleado")
            if(response.data == false)
            {
                foto.src="../../../../../matrix/public/images/person.png"
            }
            else
            {
            var formato = response.data
            foto.src="../../../../../intranet/Empresa/foto_empleado/"+this.value.nip+"."+formato
            //foto.src="../../../../../matrix/public/images/fotosEmpleados/"+this.value.nip+"."+formato
            }
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    async editDireccion(nip)
    {
        await editDireccion(nip).then((response) => {
            let arrayEdit2 = response.data
            this.value.calle = arrayEdit2.calle
            this.value.numExt = arrayEdit2.numext
            this.value.numInt = arrayEdit2.numint
            this.value.colonia = arrayEdit2.colonia
            this.value.cp = arrayEdit2.cp
            this.value.estado = arrayEdit2.idestado
            this.value.municipio = arrayEdit2.municipio   
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    editUsuario(nip)
    {
        editUsuario(nip).then((response) => {
            let arrayEdit = response.data 
            this.value.username = arrayEdit.username 
            this.value.password = arrayEdit.password 
            this.value.confirmarPassword = arrayEdit.password 
            this.value.tipoUsuario = arrayEdit.tipo 
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    editContrato(nip)
    {
        editContrato(nip).then((response) => {
            let arrayEdit = response.data
            this.value.departamento = arrayEdit.iddepartamento 
            this.value.puesto = arrayEdit.idpuesto
            this.value.tipoContrato = parseInt(arrayEdit.idtipocontrato)
            this.value.tiempoContrato = arrayEdit.idtiempocontrato
            this.value.tipoJornada = parseInt(arrayEdit.idtipojornada)
            this.value.fechaInicioLaboral = arrayEdit.fechainiciolab
            this.value.tipoRegimen = parseInt(arrayEdit.idtiporegimen)
            this.value.riesgoPuesto = parseInt(arrayEdit.idriesgopuesto)
            this.value.periodicidadPago = parseInt(arrayEdit.idperiodicidadpago)
            this.value.bancos = parseInt(arrayEdit.idbanco)
            this.value.sindicalizado = arrayEdit.sindicalizado
            this.value.salarioBase = arrayEdit.salariobase
            this.value.salarioDiario = arrayEdit.salariodiario
            this.value.cuentaBancaria = arrayEdit.cuentabancaria
            this.value.subRfc = arrayEdit.subrfc
            this.value.subPorcentaje = arrayEdit.subporcentaje
            this.getPuesto()
            this.getAntiguedad()
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    actualizarEmpleado()
    {
        updateEmpleado(this.value.nip ,this.value).then((res) => {
            if(res.data == true){
                Swal.fire({
                icon: 'success',
                title: '¡Empleado Actualizado!',
                showConfirmButton: false,
                timer: 2500
                })
            this.cleanInputs()
            }
            else{
                Swal.fire({
                icon: 'error',
                title: res.data,
                showConfirmButton: false,
                timer: 2500
                })
            }
        })
        .catch((err) => {
            alert(err.response.status) 
        });
    },
    renovarContrato()
    {
        renovarContrato(this.value).then((res) => {
            if(res.data == true){
                console.log(res)
                Swal.fire({
                icon: 'success',
                title: '¡Contrato Renovado!',
                text: 'Se ha creado un nuevo contrato al empleado',
                showConfirmButton: false,
                timer: 2500
                })
            this.cleanInputs()
            }
            else{
                Swal.fire({
                icon: 'error',
                title: res.data,
                showConfirmButton: false,
                timer: 2500
                })
            }
        })
        .catch((err) => {
            alert(err.response.status) 
        });
    },
    bajaEmpleado()
    {
        bajaEmpleado(this.value.nip).then((res) => {
            if(res.data == true){
                Swal.fire({
                    title: '¿Está seguro de dar baja al empleado '+this.value.nombre+'?',
                    text: "¡No podrás revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, dar de baja',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                            icon: 'success',
                            title: '¡Empleado Eliminado!',
                            text: 'Se ha dado de baja al empleado ',
                            showConfirmButton: false,
                            timer: 3000
                            })
                        this.cleanInputs()
                        }
                    })
            }
            else{
                Swal.fire({
                icon: 'error',
                title: res.data,
                showConfirmButton: false,
                timer: 2500
                })
            }
        })
        .catch((err) => {
            alert(err.response.status) 
        });
    },
    filtrarEmpleados()
    {       
        this.itemsAllEmpleados = this.itemsFiltroAllEmpleados
        let insertItems = []

        for (let i=0; i<this.itemsAllEmpleados.length; i++)
        {
            if(this.itemsAllEmpleados[i].id == this.departamentoSearch)
            {
                insertItems.push(this.itemsAllEmpleados[i])
                
            }
            else if (this.departamentoSearch == 'TODOS')
                insertItems = this.itemsAllEmpleados
        }
        this.itemsAllEmpleados = insertItems
    },
    mostrarPassword(){
		var cambio = document.getElementById("inputContraseña");
        var cambio2 = document.getElementById("inputConfirmarContraseña");
		if(cambio.type == "password"){
			cambio.type = "text";
            cambio2.type = "text";
			$('.icon').removeClass('fas fa-eye-slash').addClass('fas fa-eye');
		}else{
			cambio.type = "password";
            cambio2.type = "password";
			$('.icon').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
		}
        
	},
    editHijos(hijos)
    {
        if(hijos == '0-0')
            return this.value.hijos='NO'
        else{
            this.numHijas = hijos[0]
            this.numHijos = hijos[2]
            return this.value.hijos='SI'
        }
    },
    edadEmpleado(){
        var hoy = new Date();
        var cumpleanos = new Date(this.value.fechaNacimiento);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m<0 || (m === 0 && hoy.getDate() <= cumpleanos.getDate())) {
            edad--;
        }
        this.value.edad = edad;
    },
    async getItems()
    {
        await getEstadosRepublica().then((response) => {
            this.itemsEstados = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getEstadoCivil().then((response) => {
            this.itemsEstadoCivil = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getSexo().then((response) => {
            this.itemsSexo = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getNivelEstudio().then((response) => {
            this.itemsEscolaridad = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoSangre().then((response) => {
            this.itemsTipoSangre = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoSangre().then((response) => {
            this.itemsTipoSangre = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoUsuario().then((response) => {
            this.itemsTipoUsuario = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getSucursal().then((response) => {
            this.itemsSucursal = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getDepartamento().then((response) => {
            this.itemsDepartamento = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoContrato().then((response) => {
            this.itemsTipoContrato = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTiempoContrato().then((response) => {
            this.itemsTiempoContrato = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoJornada().then((response) => {
            this.itemsTipoJornada = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoRegimen().then((response) => {
            this.itemsTipoRegimen = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getRiesgoPuesto().then((response) => {
            this.itemsRiesgoPuesto = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getPeriodicidadPago().then((response) => {
            this.itemsPeriodicidadPago = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getBancos().then((response) => {
            this.itemsBancos = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        await getTipoDocumentos().then((response) => {
            this.itemsTipoDocumentos = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    async getEmpleadosAll()
    {
        this.departamentoSearch = 'TODOS'
        this.nameEmpleado = ''
         await getEmpleadosAll().then((response) => {
            this.itemsAllEmpleados = response.data
            this.itemsFiltroAllEmpleados = response.data
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    getPuesto()
    {
        this.itemsPuesto = []
        getPuesto(this.value.departamento).then((response) => {
            this.itemsPuesto = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    getAntiguedad()
    {
        var fechaHoy = new Date();
        var fechaInicioLaboral = new Date(this.value.fechaInicioLaboral);
        if(fechaInicioLaboral > fechaHoy)
        {
            this.value.fechaInicioLaboral = null
            Swal.fire({
                icon: 'error',
                title: 'No ha pasado la fecha ingresada',
                showConfirmButton: false,
                timer: 2500
            })
        }
        else{
            getAntiguedad(this.value.fechaInicioLaboral).then((response) => {
                this.value.antiguedad = response.data
        })
        .catch((err) => {
            alert(err.response.status)
        });
        }
    },
    cleanInputs(){
        this.nameEmpleado = '',
        this.numHijos = 0,
        this.numHijas = 0,
        this.value.nip = null,
        this.value.nombre = '',
        this.value.rfc = '',
        this.value.curp = '',
        this.value.nss = '',
        this.value.fechaNacimiento = null,
        this.value.edad = 0,
        this.value.estadoCivil = '',
        this.value.sexo = '',
        this.value.calle = '',
        this.value.numExt = '',
        this.value.numInt = '',
        this.value.colonia = '',
        this.value.cp = 0,
        this.value.estado = '',
        this.value.municipio = '',
        this.value.email = '',
        this.value.telefonoCelular = 0,
        this.value.telefonoFijo = 0,
        this.value.religion = '',
        this.value.hijos = null,
        this.value.escolaridad = '',
        this.value.asegurado = null,
        this.value.tipoSangre = '',
        this.value.alergias = '',
        this.value.username = '',
        this.value.password = '',
        this.value.confirmarPassword = '',
        this.value.tipoUsuario = '',
        this.value.departamento = 0,
        this.value.puesto = 0,
        this.value.sucursal = 0,
        this.value.tipoContrato = 0,
        this.value.tiempoContrato = 0,
        this.value.tipoJornada = 0,
        this.value.fechaInicioLaboral = null,
        this.value.antiguedad = '',
        this.value.tipoRegimen = 0,
        this.value.riesgoPuesto = 0,
        this.value.periodicidadPago = 0,
        this.value.bancos = 0,
        this.value.sindicalizado = '',
        this.value.salarioBase = 0,
        this.value.salarioDiario = 0,
        this.value.cuentaBancaria = 0,
        this.value.subRfc = '',
        this.value.subPorcentaje = 0

        this.button = true

        this.pdf.empleado = ''
        this.pdf.fecha = ''
        this.pdf.puesto = ''
        this.pdf.sexo = ''
        this.pdf.edad = ''
        this.pdf.edocivil = ''
        this.pdf.rfc = ''
        this.pdf.curp = ''
        this.pdf.domicilio = ''
        this.pdf.estado = ''
        var foto = document.getElementById("frameEmpleado")
        foto.src="../../../../../matrix/public/images/person.png"
        
    },
   generatePDFcontrato() {
       document.getElementById("overlay").style.display = "block";
        this.pdf.empleado = this.value.nombre
        this.pdf.fecha = this.value.fechaInicioLaboral
        this.pdf.puesto = this.value.puesto
        this.pdf.sexo = this.value.sexo
        this.pdf.edad = this.value.edad
        this.pdf.edocivil = this.value.estadoCivil
        this.pdf.rfc = this.value.rfc
        this.pdf.curp = this.value.curp
        this.pdf.domicilio = this.value.calle+' #'+this.value.numExt+', COLONIA '+this.value.colonia+', '+this.value.municipio
        this.pdf.estado = this.value.estado

        generatePDFcontrato(this.pdf).then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'file.pdf'); //or any other extension
            document.body.appendChild(link);
            link.click();
            console.log("Ya imprimio")
            document.getElementById("overlay").style.display = "none";
        })
        .catch((err) => {
            alert(err.response.status)
        });
   },
  },
};
</script>

<style>
#frameEmpleado{
width: 210px;
height: 235px;
}
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
</style>