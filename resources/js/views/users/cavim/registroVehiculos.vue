<template>
        <div class="row mx-3">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">"Sistema para el Registro de Actividades CAVIM"</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row my-2">
                                <div class="col text-center p-3" style="background-color: rgb(207, 230, 238);">
                                    <p class="h5 font-weight-bold">INFORMACIÓN DEL TICKET</p>
                                    <div class="row">
                                        <div class="form-group col-md-2 text-center">
                                            <label for="inputSucursal">Folio</label>
                                            <div class="form-row">
                                                <div class="col text-center">
                                                    <a href="#" @click="getFoliosPrediction" data-toggle="modal" data-target="#exampleModal" v-if="value.folio == null">Seleccionar...</a>
                                                    <a href="#" @click="getFoliosPrediction" data-toggle="modal" data-target="#exampleModal" v-if="value.folio != null">{{ this.value.folio }}</a>
                                                        <!-- Modal -->
                                                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pedidos Activos</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4 sm-6 xs-6 text-center">
                                                                            <label for="inputFechaFolios">Fecha</label>
                                                                            <input type="date" class="form-control" id="inputFechaFolios" v-model="fechaFolios" @change="getFoliosPrediction">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row my-4">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col">Folio</th>
                                                                                    <th scope="col">Vendedor</th>
                                                                                    <th scope="col">Fecha Ticket</th>
                                                                                    <th scope="col">Hora Ticket</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(item, i) in itemsTicketsPrediction" :key="i">
                                                                                        <td @click="seleccionarFolio(item)">
                                                                                            <div data-dismiss="modal">
                                                                                                <a href="#">
                                                                                                    {{ item.folio }}
                                                                                                </a>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{ item.vendedor }}</td>
                                                                                        <td>{{ item.fecha }}</td>
                                                                                        <td>{{ item.hora }}</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputSucursal">Sucursal</label>
                                            <select id="inputSucursal" class="form-control" readonly v-model="value.sucursal">
                                                <option v-for="(item, index) in itemsSucursal" :value="item.idprediction" :key="index" style="font-size: .9rem;">{{ item.descripcion }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputVendedor">Vendedor</label>
                                            <input type="text" class="form-control" id="inputVendedor" readonly v-model="value.vendedor">
                                        </div>
                                        <div class="form-group col-md-2 text-center">
                                            <label for="inputVendedor">Fecha de venta</label>
                                            <input type="date" class="form-control text-center" id="inputVendedor" readonly v-model="value.fechaTicket">
                                        </div>
                                        <div class="form-group col-md-2 text-center">
                                            <label for="inputVendedor">Hora de venta</label>
                                            <input type="text" class="form-control text-center" id="inputVendedor" readonly v-model="value.horaTicket">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-md-6 text-center p-3" style="background-color: rgb(235, 227, 191);">
                                    <p class="h5 font-weight-bold">INFORMACIÓN DEL VEHICULO</p>
                                    <div class="form-row">
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Marca</label>
                                            <select id="inputMarca" class="form-control" v-model="value.marca" @change="getLineaAuto">
                                                <option v-for="(item, index) in itemsMarca" :value="item.id" :key="index">{{ item.marca }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Linea</label>
                                            <select id="inputMarca" class="form-control" v-model="value.linea">
                                                <option v-for="(item, index) in itemsLinea" :value="item.id" :key="index">{{ item.modelo }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Color</label>
                                            <input type="text" class="form-control text-uppercase" id="inputVendedor" v-model="value.color">
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Telefono</label>
                                            <input type="number" class="form-control" id="inputVendedor" v-model="value.telefono">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center p-3" style="background-color: rgb(182, 235, 204);">
                                    <p class="h5 font-weight-bold">INFORMACIÓN DE CONTROL</p>
                                    <div class="form-row">
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Fecha Entrada</label>
                                            <input type="date" class="form-control" id="inputEntradaIntermedia" v-model="value.fechaEntrada">
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Hora Entrada</label>
                                            <input type="time" class="form-control" id="inputEntradaIntermedia" v-model="value.horaEntrada">
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputSucursal">Fecha Salida</label>
                                            <input type="date" class="form-control" id="inputEntradaIntermedia" v-model="value.fechaSalida">
                                        </div>
                                        <div class="form-group col-md-3 text-center">
                                            <label for="inputMarca">Hora Salida</label>
                                            <input type="time" class="form-control" id="inputEntradaIntermedia" v-model="value.horaSalida">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3 float-right">
                            <button type="button" class="btn btn-success btn-lg btn-block" @click="registrar">Registrar Vehículo</button>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">"Registros CAVIM"</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 text-center">
                                <label for="inputFechaRegistro">Fecha</label>
                                <input type="date" class="form-control" id="inputFechaRegistro" v-model="fechaRegistros" @change="getRegistrosCavim">
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-6 offset-md-8">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btn-primary" @click="exportarExcel">Exportar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Sucursal</th>
                                        <th scope="col">Folio</th>
                                        <th scope="col">Vendedor</th>
                                        <th scope="col">Fecha Ticket</th>
                                        <th scope="col">Hora Ticket</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Linea</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Fecha Entrada</th>
                                        <th scope="col">Hora Entrada</th>
                                        <th scope="col">Fecha Salida</th>
                                        <th scope="col">Hora Salida</th>
                                        <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsRegistrosCavim" :key="i">
                                            <th scope="row" >{{ item.descripcion }}</th>
                                            <td>{{ item.prediction_folio }}</td>
                                            <td>{{ item.prediction_vendedor }}</td>
                                            <td>{{ item.prediction_fecha }}</td>
                                            <td>{{ item.prediction_hora }}</td>
                                            <td>{{ item.marca }}</td>
                                            <td>{{ item.modelo }}</td>
                                            <td>{{ item.color }}</td>
                                            <td>{{ item.telefono }}</td>
                                            <td>{{ item.fechai }}</td>
                                            <td>{{ item.horai }}</td>
                                            <td>{{ item.fechaf }}</td>
                                            <td>{{ item.horaf }}</td>
                                            <td>
                                                <button class="btn btn-danger mr-2" type="button" @click="borrarRegistro(item.prediction_folio)">
                                                    <i class="fas fa-trash-alt" style="font-size: 15px"></i>
                                                </button>
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
<script >
import Swal from 'sweetalert2'
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getMarca } from "../../../network/libs/gets/gets.js";
import { getLinea } from "../../../network/libs/gets/gets.js";
import { getRegistrosCavim } from "../../../network/libs/gets/gets.js";
import { getTicketsPrediction } from "../../../network/libs/gets/gets.js";
import { borrarRegistro } from "../../../network/libs/cavim/cavim.js";
import { registrar } from "../../../network/libs/cavim/cavim.js";
import { exportarExcel } from "../../../network/libs/cavim/cavim.js";
import { existsTicketRegister } from "../../../network/libs/cavim/cavim.js";

export default {
    data() {
    return {
        itemsSucursal: [],
        itemsMarca: [],
        itemsLinea: [],
        itemsRegistrosCavim: [],
        itemsTicketsPrediction: [],
        fechaRegistros: '',
        fechaFolios: '',
        value: {
            sucursal: 0,
            folio: null,
            vendedor: '',
            fechaTicket: '',
            horaTicket: '',
            marca: 0,
            linea: 0,
            color: '',
            telefono: null,
            fechaEntrada: '',
            horaEntrada: '',
            fechaSalida: '',
            horaSalida: '',
            fecha:'',
            hora: '',
            prediction_id: 0,
            prediction_idvendedor: 0,
            prediction_total: 0,
            status: 1
        }
    }
    },
    mounted() {
        const fecha = new Date();
        this.fechaRegistros = fecha.toISOString().split('T')[0]
        this.fechaFolios = fecha.toISOString().split('T')[0]
        this.getSelects()   
        this.getRegistrosCavim()  
    },
    methods: {
        getLineaAuto() {
            getLinea(this.value.marca).then((response) => {
                this.itemsLinea = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });

        },
        async getSelects() {
            await getSucursal().then((response) => {
                this.itemsSucursal = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
            await getMarca().then((response) => {
                this.itemsMarca = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getRegistrosCavim() {
            getRegistrosCavim(this.fechaRegistros).then((response) => {
                this.itemsRegistrosCavim = response.data;
                this.itemsRegistrosCavim.reverse();
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getFoliosPrediction()
        {
            this.itemsTicketsPrediction = []
            getTicketsPrediction(this.fechaFolios).then((response) => {
                const object = response.data[0]
                for (const property in object) 
                {
                    const obj = object[`${property}`]
                    this.itemsTicketsPrediction.push(obj['cabecera'])
                }
                })
                .catch((err) => {
                    alert(err.response.status)
                    switch(err.response.status)
                    {
                        case 401:
                            window.location.replace("/login");
                            break;
                    }
            });
        },
        seleccionarFolio(ticket)
        {
            let arr = ticket.fecha.split('/');
            this.value.folio = ticket.folio
            this.value.sucursal = ticket.sucursalid
            this.value.vendedor = ticket.vendedor
            this.value.fechaTicket = arr[2]+'-'+arr[1]+'-'+arr[0]
            this.value.horaTicket = ticket.hora
            this.value.prediction_id = ticket.idpedido
            this.value.prediction_idvendedor = ticket.vendedorid
            this.value.prediction_total = ticket.total
        },
        borrarRegistro(folio)
        {
            Swal.fire({
                title: '¿Estás seguro de eliminar el registro del ticket '+folio+'?',
                text: "¡No podrás revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    borrarRegistro(folio).then((response) => {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro Eliminado!',
                            text: 'Se ha eliminado este registro',
                            showConfirmButton: false,
                            timer: 1500
                            })
                        this.getRegistrosCavim();
                        })
                        .catch((err) => {
                            alert(err.response.status)
                    });
                }
            })
        },
        async registrar(){
            if(this.value.linea == 0 || this.value.prediction_id == 0)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Completa Campos!',
                    text: 'Hace falta seleccionar el ticket o la linea',
                    showConfirmButton: false,
                    timer: 2000
                    })
            }
            else{
                const hoy = new Date();
                this.value.fecha = hoy.toISOString().split('T')[0]
                this.value.hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
                console.log(this.value)
                await registrar(this.value).then((response) => {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro Guardado!',
                        text: 'Se ha registrado este ticket',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    this.getRegistrosCavim();
                    this.cleansInputs();
                    })
                    .catch((err) => {
                        alert(err.response.status)
                });
            }
        },
        exportarExcel() {
            if(this.itemsRegistrosCavim.length == 0){
                Swal.fire({
                    icon: 'warning',
                    title: '¡No existen registros!',
                    text: 'No se han registrado tickets con esa fecha',
                    showConfirmButton: false,
                    timer: 2000
                    })
                }
            else{
            exportarExcel(this.fechaRegistros).then((response) => {

                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'CAVIM.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                })
                .catch((err) => {
                    alert(err.response.status)
            });
            }
        },
        cleansInputs()
        {
            this.value.sucursal = 0,
            this.value.folio = null,
            this.value.vendedor = '',
            this.value.fechaTicket = '',
            this.value.horaTicket = '',
            this.value.marca = 0,
            this.value.linea = 0,
            this.value.color = '',
            this.value.telefono = null,
            this.value.fechaEntrada = '',
            this.value.horaEntrada = '',
            this.value.fechaSalida = '',
            this.value.horaSalida = '',
            this.value.fecha ='',
            this.value.hora = '',
            this.value.prediction_id = 0,
            this.value.prediction_idvendedor = 0,
            this.value.prediction_total = 0
        }
    }
}
</script>
