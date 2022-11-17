<template>
    <div class="row mx-2">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Nuevo Resguardo</h5>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 200px !important">
                            <div id="overlay">    
                            </div>          
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                        <label for="inputNombre">Empleado*</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-uppercase" id="inputCliente" v-model="value.empleado" v-on:keyup.13="searchEmpleado" @dblclick="clearEmpleado">
                                            <div class="input-group-append">
                                                <button id="show_confirmpassword" class="btn btn-light" type="button" data-toggle="modal" data-target="#exampleModalCenter" @click="searchEmpleado">
                                                <span class="fas fa-search"></span> </button>
                                            </div>
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
                                                            <table class="table table-striped table-hover" data-dismiss="modal">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nombre del Empleado</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(item,i) in itemsEmpleado" :key="i">
                                                                        <td scope="row" @click="selectEmpleado(item)">{{ item.nombre  }}</td>
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
                                        </div>   
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                        <label for="inputFechaNacimiento">NIP</label>
                                        <input type="text" class="form-control" id="inputfecha" v-model="value.nip" :disabled="inputsDisabled">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                        <label for="inputFechaNacimiento">Telefono</label>
                                        <input type="text" class="form-control" id="inputfecha" v-model="value.telefono" :disabled="inputsDisabled">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <label for="inputFechaNacimiento">Direccion</label>
                                        <input type="text" class="form-control" id="inputfecha" v-model="value.direccion" :disabled="inputsDisabled">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <label for="inputFechaNacimiento">UDN</label>
                                        <input type="text" class="form-control" id="inputfecha" v-model="value.nameSucursal" :disabled="inputsDisabled">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <label for="inputFechaNacimiento">Departamento</label>
                                        <input type="text" class="form-control" id="inputfecha" v-model="value.nameDepartamento" :disabled="inputsDisabled">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <label for="inputFechaNacimiento">Puesto</label>
                                        <input type="text" class="form-control" id="inputfecha" v-model="value.namePuesto" :disabled="inputsDisabled">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-row justify-content-center">
                                            <img id="imgEmpleado" src="" class="rounded img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFechaNacimiento">Equipo*</label>
                                <select id="inputSucursal" class="form-control text-uppercase" v-model="resguardo.equipoComputo">
                                    <option v-for="(item, index) in itemsTipo" :value="item.id" :key="index">
                                        {{ item.nombreSubcategoria }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFechaNacimiento">Fecha*</label>
                                <input type="date" class="form-control" id="inputfecha" v-model="resguardo.fecha">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFechaNacimiento">Marca*</label>
                                <input type="text" class="form-control text-uppercase" id="inputfecha" v-model="resguardo.marca">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFechaNacimiento">Modelo*</label>
                                <input type="text" class="form-control text-uppercase" id="inputfecha" v-model="resguardo.modelo">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFechaNacimiento">Serie (IMEI)*</label>
                                <input type="text" class="form-control text-uppercase" id="inputfecha" v-model="resguardo.serie">
                            </div>
                        </div>
                        <div v-if="resguardo.equipoComputo == 1 || resguardo.equipoComputo == 3" class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFechaNacimiento">Sistema Operativo</label>
                                <input type="text" class="form-control text-uppercase" id="inputfecha" v-model="resguardo.sistemaoperativo">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFechaNacimiento">Procesador</label>
                                <input type="text" class="form-control text-uppercase" id="inputfecha" v-model="resguardo.procesador">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFechaNacimiento">Disco Duro (GB)</label>
                                <input type="number" class="form-control" id="inputfecha" v-model="resguardo.discoduro">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFechaNacimiento">Memoria RAM (GB)</label>
                                <input type="number" class="form-control" id="inputfecha" v-model="resguardo.memoriaram">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFechaNacimiento">Estado*</label>
                                <select id="inputSucursal" class="form-control" v-model="resguardo.estado">
                                    <option>NUEVO</option>
                                    <option>USADO</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFotos">Fotos (De 2 a mas)</label>
                                <input type="file" class="form-control" accept="image/*" id="multiplesFotosResguardo" multiple @change="previewImages($event)"/>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row">
                                    <label>Observaciones*</label>
                                    <textarea class="form-control text-uppercase" v-model="resguardo.observaciones" placeholder="Describe caracteristicas del equipo y lo que este incluye" id="exampleFormControlTextarea1" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-1 d-flex align-items-center justify-content-center">
                                <button class="btn btn-primary mr-2" type="button" @click="addEquipo">
                                    <i class="fas fa-plus" style="font-size: 50px"></i>
                                    <span class="row justify-content-md-center"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Resguardos</h5>
                    </div>
                    <div class="card-body">
                       <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label for="inputSucursal">Empleado</label>
                                <select id="inputSucursal" class="form-control" v-model="filtroEmpleado" @change="getResguardoEmpleado">
                                    <option v-for="(item, index) in itemsAllEmpleados" :value="item" :key="index">{{ item.nombre }}</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 offset-md-6 my-4">
                                <button type="button" class="btn btn-success btn-lg btn-block" @click="imprimirResguardo">Imprimir</button>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Sucursal</th>
                                        <th scope="col">Equipo</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Fecha</th>
                                        <th class="row justify-content-md-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsResguardos" :key="i">
                                            <th>{{ item.sucursal }}</th>
                                            <td>{{ item.equipo }}</td>
                                            <td>{{ item.marca }}</td>
                                            <td>{{ item.modelo }}</td>
                                            <td>{{ item.fecha }}</td>
                                            <td>
                                                <div v-if="item.status != 99" class="row justify-content-center">
                                                        <button v-if="item.status != 0" class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#modalVerEquipos" @click="verFotos(item)">
                                                            <i class="fas fa-eye" style="font-size: 15px"></i>
                                                        </button>
                                                        <!-- Modal -->
                                                            <div class="modal fade bd-example-modal-lg" id="modalVerEquipos" tabindex="-1" role="dialog" aria-labelledby="modalVerEquipos" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">{{ item.nombre }}</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="table table-striped table-hover" data-dismiss="modal">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Imagen</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(item,i) in itemsFotos" :key="i">
                                                                                        <td>{{ i+1 }}</td>
                                                                                        <td>
                                                                                            <img id="frame" :src="`../../../../../matrix/public/${item}`">
                                                                                        </td>
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
                                                        <!--Fin Modal-->
                                                 
                                                        <button class="btn btn-success mr-2" type="button" @click="editarResguardo(i, item)">
                                                            <i class="fas fa-edit" style="font-size: 15px"></i>
                                                        </button>
                                                        <!-- Modal -->
                                                            <div class="modal fade bd-example-modal-lg" id="modalEditResguardo" tabindex="-1" role="dialog" aria-labelledby="modalEditResguardoTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Asignar equipo de computo a nuevo empleado</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                                                                    <label for="inputSucursal">Empleado*</label>
                                                                                    <select id="inputSucursal" class="form-control" v-model="nuevo.empleado" @change="getNuevoEmpleado">
                                                                                        <option v-for="(item, index) in itemsAllEmpleados" :value="item.nombre" :key="index">{{ item.nombre }}</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                                                                    <label for="inputFechaNacimiento">UDN</label>
                                                                                    <input type="text" class="form-control" id="inputfecha" v-model="nuevo.nameSucursal" :disabled="inputsDisabled">
                                                                                </div>
                                                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                                                                    <label for="inputFechaNacimiento">Estado*</label>
                                                                                    <select id="inputSucursal" class="form-control" v-model="nuevo.estado">
                                                                                        <option>NUEVO</option>
                                                                                        <option>USADO</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                                                                    <label for="inputFechaNacimiento">Fecha*</label>
                                                                                    <input type="date" class="form-control" id="inputfecha" v-model="nuevo.fecha">
                                                                                </div>
                                                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                                                                    <label for="inputFechaNacimiento">Marca*</label>
                                                                                    <input type="text" class="form-control" id="inputfecha" v-model="nuevo.marca">
                                                                                </div>
                                                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                                                                    <label for="inputFechaNacimiento">Modelo*</label>
                                                                                    <input type="text" class="form-control" id="inputfecha" v-model="nuevo.modelo">
                                                                                </div>
                                                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                                                                    <label for="inputFechaNacimiento">Serie (IMEI)*</label>
                                                                                    <input type="text" class="form-control" id="inputfecha" v-model="nuevo.serie">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                                                                    <label for="inputFotos">Fotos (De 2 a mas)*</label>
                                                                                    <input type="file" class="form-control" accept="image/*" id="multiplesFotosResguardo" multiple @change="previewImages($event)"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                                                                    <div class="row">
                                                                                        <label>Observaciones*</label>
                                                                                        <textarea class="form-control" v-model="nuevo.observaciones" placeholder="Describe caracteristicas del equipo y lo que este incluye" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" @click="crearResguardo">Crear</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <!--Fin Modal Buscar Empleado-->
                                                        <button class="btn btn-danger mr-2" type="button" @click="borrarResguardo(item)">
                                                            <i class="fas fa-times" style="font-size: 15px"></i>
                                                        </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
</template>

<script>
import Swal from 'sweetalert2'
import { searchEmpleado } from "../../../network/libs/gets/gets.js";
import { getSubcategoria } from "../../../network/libs/gets/gets.js";
import { saveResguardo } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { uploadPhotosResguardos } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getEmpleadosAll } from "../../../network/libs/gets/gets.js";
import { getResguardos } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { borrarResguardo } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { imprimirResguardo } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { verFotosResguardos } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { editFotoEmpleado } from "../../../network/libs/nomina/nomina.js";

export default {
    data() {
        return {
            inputsDisabled: true,
            itemsEmpleado: [],
            itemsTipo: [],
            Arrayimage: [],
            value: {
                empleado: '',
                nip: null,
                sucursal: null,
                telefono: null,
                departamento: null,
                puesto: null,
                direccion: null,
                nameSucursal: '',
                nameDepartamento: '',
                namePuesto: ''
            },
            resguardo: {
                equipoComputo: 0,
                fecha: null,
                marca: null,
                modelo: null,
                serie: null,
                sistemaoperativo: null,
                procesador: null,
                discoduro: null,
                memoriaram: null,
                estado: "USADO",
                observaciones: null
            },
            nuevo:{
                empleado: '',
                nip: null,
                nameSucursal: null,
                telefono: null,
                departamento: null,
                puesto: null,
                direccion: null,
                marca: null,
                modelo: null,
                serie: null, 
                estado: "USADO",
                fecha: null,
                sucursal: 0,
                observaciones: '',
                equipoComputo: 0
            },
            filtroEmpleado: null,
            itemsAllEmpleados: null,
            itemsResguardos: null,
            itemsFotos: null,
            idEquipoComputo: 0
        }
    },
    mounted() {
        var foto = document.getElementById("imgEmpleado")
        foto.src="../../../../../matrix/public/images/person.png"
        let date = new Date();
        this.resguardo.fecha = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
        this.nuevo.fecha = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
        getSubcategoria(1).then((response) => {
          this.itemsTipo = response.data;
        })
        .catch((err) => {
          alert(err.response.status);
        });
        getEmpleadosAll().then((response) => {
            this.itemsAllEmpleados = response.data
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },

    methods: {
        verFotos(item)
        {
            verFotosResguardos(item.id).then((response) => {
                this.itemsFotos = response.data
            })
            .catch((err) => {
                alert(err.response.status)
            });
            //this.idEquipoComputo = item.id
            
        },
        searchEmpleado()
        {
            $('#exampleModalCenter').modal('toggle')
            searchEmpleado(this.value.empleado).then((response) => {
                this.itemsEmpleado = response.data
            })
            .catch((err) => {
                alert(err.response.status)
            });
        },
        previewImages(event)
        {
            let size = event.target.files.length;
            for(let i=0; i<size; i++)
            {
                this.Arrayimage[i] = event.target.files[i]
            }
        },
        imprimirResguardo()
        {
            searchEmpleado(this.filtroEmpleado.nombre).then((response) => {
                //let searchEmpleado = response.data
                let searchEmpleado = {
                empleado: response.data[0].nombre,
                nip: response.data[0].nip,
                sucursal: response.data[0].idSucursal,
                telefono: response.data[0].celular,
                departamento: response.data[0].iddepartamento,
                puesto: response.data[0].idpuesto,
                direccion: response.data[0].calle+" #"+response.data[0].numext+", COLONIA "+response.data[0].colonia,
                nameSucursal: response.data[0].nameSucursal,
                nameDepartamento: response.data[0].departamento,
                namePuesto: response.data[0].puesto,
                }
                document.getElementById("overlay").style.display = "block";
                imprimirResguardo(searchEmpleado).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'Resguardo-'+searchEmpleado.empleado+'.pdf'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                    
                    document.getElementById("overlay").style.display = "none";
                })
                .catch((err) => {
                    alert(err.response.status)
                });
            })
            .catch((err) => {
                alert(err.response.status)
            });
        },
        getResguardoEmpleado()
        {
            getResguardos(this.filtroEmpleado.nip).then((response) => {
                this.itemsResguardos = response.data
            })
            .catch((err) => {
                alert(err.response.status)
            });
        },
        editarResguardo(i, item)
        {
            this.Arrayimage = []
            document.getElementById("multiplesFotosResguardo").value = "";
            $('#modalEditResguardo').modal('toggle')
            this.nuevo.marca = item.marca
            this.nuevo.modelo = item.modelo
            this.nuevo.serie = item.serie
            this.nuevo.equipoComputo = item.idequipo
            this.nuevo.idAnterior = item.id
        },
        getNuevoEmpleado()
        {
            searchEmpleado(this.nuevo.empleado).then((response) => {
                this.nuevo.empleado = response.data[0].nombre
                this.nuevo.nip = response.data[0].nip
                this.nuevo.sucursal = response.data[0].idSucursal
                this.nuevo.nameSucursal = response.data[0].nameSucursal
                this.nuevo.telefono = response.data[0].celular
                this.nuevo.departamento = response.data[0].iddepartamento
                this.nuevo.puesto = response.data[0].idpuesto
                this.nuevo.direccion = response.data[0].calle+" #"+response.data[0].numext+", COLONIA "+response.data[0].colonia
            })
            .catch((err) => {
                alert(err.response.status)
            });
        },
        crearResguardo()
        {
            if(this.Arrayimage.length == 0 || this.nuevo.observaciones == '' || this.nuevo.nip == null)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Faltan Campos!',
                    text: 'Selecciona al empleado, fotos y observaciones',
                    showConfirmButton: false,
                    timer: 1500
                })   
            }
            else{
                document.getElementById("overlay").style.display = "block";
                saveResguardo(this.nuevo).then((response) => {
                this.uploadPhotosResguardos(response.data);
                this.clearEquipo()
                $('#modalEditResguardo').modal('hide')
                this.getResguardoEmpleado()
                document.getElementById("overlay").style.display = "none";
            })
            .catch((err) => {
                alert(err.response.status)
            });
            }
        },
        borrarResguardo(item)
        {
            Swal.fire({
                title: '¿Estás seguro de eliminar el resguardo?',
                text: "¡No podrás revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if(result.isConfirmed) {
                    borrarResguardo(item.id).then((response) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Resguardo eliminado!',
                            text: 'Se ha eliminado el resguardo del empleado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.getResguardoEmpleado()
                    })
                    .catch((err) => {
                        alert(err.response.status)
                    });
                }
            })
        },
        addEquipo()
        {
            let data = Object.assign({}, this.value, this.resguardo);
            saveResguardo(data).then((response) => {
                this.uploadPhotosResguardos(response.data);
                this.clearEquipo()
                this.getResguardoEmpleado()
            })
            .catch((err) => {
                alert(err.response.status)
            });
        },
        async uploadPhotosResguardos(nameFolder) {
            let statusUpload = true
            for (let i = 0; i < this.Arrayimage.length; i++) 
            {
                let data = new FormData();
                data.append("foto", this.Arrayimage[i]);
                data.append("codigo", 'image'+(i+1));
                data.append("name", nameFolder);

                await uploadPhotosResguardos(data).then((response) => {
                    statusUpload = response.data
                })
                .catch((err) => {
                    switch (err.response.status) {
                    case 422:
                        Swal.fire({
                        icon: "error",
                        title: "Archivo Erroneo",
                        showConfirmButton: false,
                        timer: 2500,
                        });
                    case 200:
                        Swal.fire({
                        icon: "error",
                        title: "ERROR",
                        showConfirmButton: false,
                        timer: 2500,
                        });
                    }
                })
                if(statusUpload == false)
                    break
            }
            if(statusUpload == true)
            {
                Swal.fire({
                    icon: "success",
                    title: "Imagenes Registradas!",
                    text: "Las imagenes han sido almacenadas exitosamente",
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
        },
        selectEmpleado(item)
        {
            editFotoEmpleado(item.nip).then((response) => {
            var foto = document.getElementById("imgEmpleado")
            if(response.data == false)
            {
                foto.src="../../../../../matrix/public/images/person.png"
            }
            else
            {
            var formato = response.data
            //foto.src="../../../../../intranet/Empresa/foto_empleado/"+this.value.nip+"."+formato
            //foto.src="../../../../../matrix/public/images/fotosEmpleados/"+this.value.nip+"."+formato
            foto.src="../../../../../intranet/Empresa/foto_empleado/"+item.nip+"."+formato
            }
        })
        .catch((err) => {
            alert(err.response.status)
        });
            
            this.value.empleado = item.nombre
            this.value.nip = item.nip
            this.value.sucursal = item.idSucursal
            this.value.telefono = item.celular
            this.value.departamento = item.iddepartamento
            this.value.puesto = item.idpuesto
            this.value.direccion = item.calle+" #"+item.numext+", COLONIA "+item.colonia
            this.value.nameSucursal = item.nameSucursal
            this.value.nameDepartamento = item.departamento
            this.value.namePuesto = item.puesto
        },
        clearEmpleado()
        {
            this.value.empleado = '',
            this.value.nip = null,
            this.value.sucursal = null,
            this.value.telefono = null,
            this.value.departamento = null,
            this.value.puesto = null,
            this.value.direccion = null
            this.value.nameSucursal = ''
            this.value.nameDepartamento = ''
            this.value.namePuesto = ''
            var foto = document.getElementById("imgEmpleado")
            foto.src="../../../../../matrix/public/images/person.png"
            this.clearEquipo()
        },
        clearEquipo()
        {
            this.resguardo.equipoComputo = 0,
            this.resguardo.fecha = null,
            this.resguardo.marca = null,
            this.resguardo.modelo = null,
            this.resguardo.serie = null,
            this.resguardo.sistemaoperativo = null,
            this.resguardo.procesador = null,
            this.resguardo.discoduro = null,
            this.resguardo.memoriaram = null,
            this.resguardo.estado = "USADO",
            this.resguardo.observaciones = null
            document.getElementById("multiplesFotosResguardo").value = "";

            this.nuevo.empleado = '',
            this.nuevo.nip = null,
            this.nuevo.nameSucursal = null,
            this.nuevo.telefono = null,
            this.nuevo.departamento = null,
            this.nuevo.puesto = null,
            this.nuevo.direccion = null,
            this.nuevo.marca = null,
            this.nuevo.modelo = null,
            this.nuevo.serie = null, 
            this.nuevo.estado = "USADO",
            this.nuevo.fecha = null,
            this.nuevo.sucursal = 0,
            this.nuevo.observaciones = '',
            this.nuevo.equipoComputo = 0
        }
    }
}
</script>

<style>
#imgEmpleado{
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