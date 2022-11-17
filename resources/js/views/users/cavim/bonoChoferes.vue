<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Bono Choferes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <label for="labelSucursal">Chofer</label>
                                <select id="inputSucursal" class="form-control" v-model="chofer" @change="sucursalEmpleado">
                                    <option v-for="(item, index) in itemsChoferes" :value="item" :key="index">{{ item.nombre }}</option>
                                </select>
                            </div>
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputSucursal">Sucursal</label>
                                <select id="inputSucursal" class="form-control" v-model="value.sucursal" disabled>
                                    <option v-for="(item, index) in itemsSucursal" :value="item.id" :key="index" style="font-size: .9rem;">{{ item.descripcion }}</option>
                                </select>
                            </div>
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputMarca">Fecha</label>
                                <input type="date" class="form-control" id="inputEntradaIntermedia" v-model="value.fecha">
                            </div>
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFotos">Foto</label>
                                <input type="file" class="form-control" accept="image/*" id="FileFoto" @change="previewImages($event)"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" v-model="value.asistencia">
                                    <label class="form-check-label" for="inlineCheckbox1">ASISTENCIA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" v-model="value.puntualidad">
                                    <label class="form-check-label" for="inlineCheckbox2">PUNTUALIDAD</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" v-model="value.uniforme">
                                    <label class="form-check-label" for="inlineCheckbox2">UNIFORME</label>
                                </div>
                            </div>
                        </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-primary" @click="registrar">Guardar</button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Choferes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFamilia">Fecha inicial</label>
                                <input type="date" class="form-control" id="inputEntradaIntermedia" v-model="filtro.fechaInicial" @change="filtros">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                <label for="inputFamilia">Fecha final</label>
                                <input type="date" class="form-control" id="inputEntradaIntermedia" v-model="filtro.fechaFinal" @change="filtros">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <label for="inputFamilia">Chofer</label>
                                <select id="inputCliente" class="form-control" v-model="filtro.chofer" @change="filtros">
                                    <option value="0">TODOS</option>
                                    <option v-for="(item, index) in itemsFiltroChoferes" :value="item.nip" :key="index">{{ item.nombre }}</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2 align-self-center offset-md-2">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btn-success btn-lg" @click="exportarExcelBonoChoferes">
                                        <i class="fas fa-file-excel" style="font-size: 30px"></i>
                                        <span class="row justify-content-md-center">Excel</span>
                                    </button>
                                </div>
                            </div>
                            
                            <!--<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFamilia">Sucursal</label>
                                <select id="inputCliente" class="form-control" v-model="filtro.sucursal" @change="filtros">
                                    <option value="0">TODOS</option>
                                    <option v-for="(item, index) in itemsFiltroSucursal" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                </select>
                            </div>-->
                        </div>
                        <div class="row my-4">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sucursal</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Chofer</th>
                                            <th scope="col">Asistencia</th>
                                            <th scope="col">Puntualidad</th>
                                            <th scope="col">Uniforme</th>
                                            <th scope="col">Ver foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsBonosChoferes" :key="i">
                                            <th>{{ item.descripcion }}</th>
                                            <td>{{ item.fecha }}</td>
                                            <td>{{ item.nombre }}</td>
                                            <td>
                                                <div v-if="item.asistencia == 1" class="row justify-content-center">
                                                    <button class="btn btn-success mr-2">
                                                        <i class="fas fa-check" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                                <div v-if="item.asistencia != 1" class="row justify-content-center">
                                                    <button class="btn btn-danger mr-2">
                                                        <i class="fas fa-times" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div v-if="item.puntualidad == 1" class="row justify-content-center">
                                                    <button class="btn btn-success mr-2">
                                                        <i class="fas fa-check" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                                <div v-if="item.puntualidad != 1" class="row justify-content-center">
                                                    <button class="btn btn-danger mr-2">
                                                        <i class="fas fa-times" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div v-if="item.uniforme == 1" class="row justify-content-center">
                                                    <button class="btn btn-success mr-2">
                                                        <i class="fas fa-check" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                                <div v-if="item.uniforme != 1" class="row justify-content-center">
                                                    <button class="btn btn-danger mr-2">
                                                        <i class="fas fa-times" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#ModalPagos" @click="getFotoBonoChofer(item)">
                                                        <i class="fas fa-eye" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="ModalPagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Fotografia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <img id="frameChofer" :src="`../../../../../matrix/public/images/cavim/BonoChoferes/${this.idFotoChofer}.jpeg`">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--Fin Modal-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getChoferes } from "../../../network/libs/cavim/cavim.js";
import { saveBonoChofer } from "../../../network/libs/cavim/cavim.js";
import { uploadFotoBono } from "../../../network/libs/cavim/cavim.js";
import { getBonosChoferesFiltros } from "../../../network/libs/cavim/cavim.js";
import { exportarExcelBonoChoferes } from "../../../network/libs/cavim/cavim.js";

export default {
    data() {
        return {
            itemsSucursal: [],
            itemsChoferes: [],
            chofer: null,
            image: null,
            value: {
                sucursal: 0,
                fecha: null,
                idChofer: 0,
                asistencia: false,
                puntualidad: false,
                uniforme: false
            },
            itemsFiltroChoferes: [],
            itemsFiltroSucursal: [],
            itemsBonosChoferes: [],
            filtro: {
                fechaInicial: null,
                fechaFinal: null,
                chofer: 0,
                sucursal: 0
            },
            idFotoChofer: 0
        }
    },
    mounted() {
        this.getSelects()
        this.filtros()
        let date = new Date();
        this.value.fecha = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
        this.filtro.fechaInicial = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
        this.filtro.fechaFinal = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
    },
    methods: {
        getSelects()
        {
            getSucursal().then((response) => {
                this.itemsSucursal = response.data
                this.itemsFiltroSucursal = response.data
                })
                .catch((err) => {
                    alert(err.response.status)
            });
            getChoferes().then((response) => {
                this.itemsChoferes = response.data   
                this.itemsFiltroChoferes = response.data             
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        exportarExcelBonoChoferes()
        {
            console.log(this.itemsBonosChoferes)
            exportarExcelBonoChoferes(this.itemsBonosChoferes).then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'Bono Choferes.xlsx'); //or any other extension
            document.body.appendChild(link);
            link.click();
            })
            .catch((error) => {
                console.log(error);
            });
        },
        filtros()
        {
            this.filtro.chofer = parseInt(this.filtro.chofer)
            this.filtro.sucursal = parseInt(this.filtro.sucursal)
            getBonosChoferesFiltros(this.filtro).then((response) => {
                this.itemsBonosChoferes = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getFotoBonoChofer(item)
        {
            this.idFotoChofer = item.id
        },
        sucursalEmpleado()
        {
            this.value.sucursal = this.chofer.idsucursal
            this.value.idChofer = this.chofer.nip
        },
        registrar()
        {
            //let status = isNaN(this.Arrayimage[m])
            if(this.value.idChofer == 0)
            {
                Swal.fire({
                    icon: "error",
                    title: "Falta chofer",
                    text: "Selecciona un chofer",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
            else if(this.image == null)
            {
                Swal.fire({
                    icon: "error",
                    title: "Falta imagen del chofer",
                    text: "Selecciona una foto",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
            else
            {
                saveBonoChofer(this.value).then((response) => {
                    this.uploadFoto(response.data)
                    this.cleanInputs()  
                    this.filtros()    
                })
                .catch((err) => {
                    alert(err.response.status)
                });
            }
        },
        previewImages(event)
        {
            this.image = event.target.files[0]
        },
        uploadFoto(idFoto)
        {
            let foto = this.image
            let data = new FormData();
            data.append("foto", foto);
            data.append("codigo", idFoto);
            data.append("name", 'BonoChoferes');

            uploadFotoBono(data).then((response) => {
            Swal.fire({
                icon: 'success',
                title: '¡Registro Almacenado!',
                text: 'Se ha registrado al chofer',
                showConfirmButton: false,
                timer: 1500
            })
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
        },
        cleanInputs()
        {
            this.chofer = null
            this.value.sucursal = 0
            this.value.idChofer = 0
            this.value.asistencia = false
            this.value.puntualidad = false
            this.value.uniforme = false
            this.image = null
            document.getElementById("FileFoto").value = "";
        }
    }
}
</script>

<style>
    #frameChofer{
    width: 300px;
    height: 440px;
    }
</style>
