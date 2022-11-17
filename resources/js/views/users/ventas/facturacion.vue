<template>
    <div class="row mx-2">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Facturación</h5>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="inputNombre">Cliente*</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-uppercase" id="inputCliente" :disabled="inputsDisabled" v-model="value.nameCliente" v-on:keyup.13="getNameCliente" @dblclick="sinCliente">
                                        <div class="input-group-append">
                                            <button id="show_confirmpassword" class="btn btn-light" type="button" data-toggle="modal" data-target="#exampleModalCenter" @click="getNameCliente">
                                            <span class="fas fa-search"></span> </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Buscar Cliente</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-hover" data-dismiss="modal">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre del Cliente</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(item,i) in itemsClientes" :key="i">
                                                                    <td scope="row" @click="selectEmpleado(item)">{{ item.NOMBRE  }}</td>
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
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFechaNacimiento">Fecha Inicial*</label>
                                <input type="date" class="form-control" id="inputfecha" :disabled="inputsDisabled" v-model="value.fechaInicial">
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFechaNacimiento">Fecha Final*</label>
                                <input type="date" class="form-control" id="inputFechaFinal" :disabled="inputsDisabled" v-model="value.fechaFinal">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFamilia">Almacen*</label>
                                <select id="inputAlmacen" class="form-control" v-model="value.sucursal" :disabled="inputsDisabled">
                                    <option value="0">TODOS</option>
                                    <option v-for="(item, index) in itemsSucursal" :value="item.idprediction" :key="index">
                                        {{ item.descripcion }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <label for="inputFamilia">Forma de Pago*</label>
                                <select id="inputPago" class="form-control" v-model="value.formaPago" :disabled="inputsDisabled">
                                    <option value="0">TODOS</option>
                                    <option v-for="(item, index) in itemsFormaPago" :value="item.FORMAPAGO" :key="index">
                                        {{ item.FORMAPAGO }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3 align-self-center"> 
                                <div class="form-row justify-content-center">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-row justify-content-center">
                                            <button type="button" class="btn btn-success btn-lg" @click="buscar">Buscar</button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-row justify-content-center">
                                            <button type="button" class="btn btn-primary btn-lg" @click="cleanInputs">Nuevo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <table class="table table-striped table-hover" data-dismiss="modal">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Ticket</th>
                                            <th>Cliente</th>
                                            <th>Subtotal</th>
                                            <th>Total</th>
                                            <th>Forma de Pago</th>
                                        </tr>
                                    </thead>
                                    <div style="height: 600px;overflow: scroll;">
                                        <tbody style="font-size: 12px;">
                                            <tr v-for="(item,i) in itemsTickets" :key="i">
                                                <td scope="row" @click="selectTicket(item)">{{ item.FECHA  }}</td>
                                                <td scope="row" @click="selectTicket(item)">{{ item.FOLIO  }}</td>
                                                <td scope="row" @click="selectTicket(item)">{{ item.CLIENTE  }}</td>
                                                <td scope="row" @click="selectTicket(item)">{{ item.IMPORTEFP  }}</td>
                                                <td scope="row" @click="selectTicket(item)">{{ item.IMPORTE  }}</td>
                                                <td scope="row" @click="selectTicket(item)">{{ item.FORMAPAGO  }}</td>
                                            </tr>
                                        </tbody>
                                    </div>
                                </table>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <table class="table table-striped table-hover" data-dismiss="modal">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Ticket</th>
                                            <th>Cliente</th>
                                            <th>Subtotal</th>
                                            <th>Total</th>
                                            <th>Forma de Pago</th>
                                        </tr>
                                    </thead>
                                    <div style="height: 600px;overflow: scroll;">
                                        <tbody style="font-size: 12px;">
                                            <tr v-for="(item,i) in itemsTicketsFacturar" :key="i">
                                                <td scope="row" @click="deselectTicket(item.ID)">{{ item.FECHA  }}</td>
                                                <td scope="row" @click="deselectTicket(item.ID)">{{ item.FOLIO  }}</td>
                                                <td scope="row" @click="deselectTicket(item.ID)">{{ item.CLIENTE  }}</td>
                                                <td scope="row" @click="deselectTicket(item.ID)">{{ item.IMPORTEFP  }}</td>
                                                <td scope="row" @click="deselectTicket(item.ID)">{{ item.IMPORTE  }}</td>
                                                <td scope="row" @click="deselectTicket(item.ID)">{{ item.FORMAPAGO  }}</td>
                                            </tr>
                                        </tbody>
                                    </div>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Datos a facturar</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" class="form-control text-uppercase" id="inputNombre" v-model="factura.nombre">  
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <label for="inputNombre">Total</label>
                            <input type="number" class="form-control" id="inputNombre" disabled v-model="factura.total">  
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <label for="inputFamilia">Uso de CFDI*</label>
                            <select id="inputCliente" class="form-control" v-model="factura.usoCfdi">
                                <option v-for="(item, index) in itemsUsoCfdi" :value="item.ID" :key="index">
                                    {{ item.VALOR }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2 align-self-center"> 
                            <div class="form-row justify-content-center">
                                <button type="button" class="btn btn-success btn-lg" @click="facturar">Facturar</button>
                            </div>
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
import { getNameCliente } from "../../../network/libs/gets/gets.js";
import { getFormaPago } from "../../../network/libs/gets/gets.js";
import { getUsoCfdi } from "../../../network/libs/gets/gets.js";
import { getTicketsFacturacion } from "../../../network/libs/ventas/ventas.js";
import { getTicketAnticipo } from "../../../network/libs/ventas/ventas.js";


    export default {
        data() {
            return {
                inputsDisabled: false,
                itemsSucursal: [],
                itemsClientes: [],
                itemsFormaPago: [],
                itemsUsoCfdi: [],
                itemsTickets: [],
                itemsTicketsFacturar: [],
                value:{
                    idCliente : 0,
                    nameCliente: '',
                    fechaInicial: null,
                    fechaFinal: null,
                    sucursal: 0,
                    formaPago: 0,
                },
                factura: {
                    nombre: '',
                    total: 0,
                    usoCfdi: null
                }
                
            };
        },
        mounted() {
            getSucursal().then((response) => {
                this.itemsSucursal = response.data;
            })
            .catch((err) => {
                alert(err.response.status);
            });
            this.getFormaPago()
            this.getUsoCfdi()
            this.fechaInputs()
        },
        
        methods:{
            fechaInputs()
            {
                let date = new Date();
                this.value.fechaInicial = String(date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-01')
                this.value.fechaFinal = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
            },
            getNameCliente() 
            {
                $('#exampleModalCenter').modal('toggle')
                this.value.nameCliente = this.value.nameCliente.toUpperCase();
                getNameCliente(this.value.nameCliente).then((res) => {
                    console.log(res)
                    this.itemsClientes = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },
            getFormaPago()
            {
                getFormaPago().then((res) => {
                    this.itemsFormaPago = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },
            getUsoCfdi()
            {
                getUsoCfdi().then((res) => {
                    this.itemsUsoCfdi = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },
            sinCliente()
            {
                this.value.nameCliente = ''
                this.value.idCliente = 0
                document.getElementById('inputCliente').style.background='#FFFFFF';
            },
            selectEmpleado(cliente)
            {
                this.value.nameCliente = cliente.NOMBRE
                this.value.idCliente = cliente.ID
                document.getElementById('inputCliente').style.background='#FFFF33';
            },
            buscar()
            {
                this.inputsDisabled = true
                if(this.value.fechaInicial == null || this.value.fechaFinal == null)
                {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Fechas Vacias!',
                        text: 'Ingresa una fecha inicial y una fecha final',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                else
                {
                    if(this.value.sucursal == '0')
                        this.value.sucursal = parseInt(this.value.sucursal)
                    if(this.value.formaPago == '0')
                        this.value.formaPago = parseInt(this.value.formaPago)
                    document.getElementById('inputCliente').style.background='#FFFF33';
                    let data = {
                        cliente: this.value.idCliente,
                        fechainicial: this.value.fechaInicial,
                        fechafinal: this.value.fechaFinal,
                        almacen: this.value.sucursal,
                        formapago: this.value.formaPago
                    }
                    getTicketsFacturacion(data).then((res) => {
                        this.itemsTickets = res.data
                        this.factura.nombre = this.value.nameCliente
                    })
                    .catch((err) => {
                        console.log(err);
                    });
                }
            },
            facturar()
            {
                console.log(this.factura)
            },
            selectTicket(item)
            {
                let status = false;
                if(item.LIQUIDACION == 1 && this.itemsTicketsFacturar.length == 0)
                {
                    getTicketAnticipo(item.ID).then((res) => {
                        this.itemsTicketsFacturar.push(item)
                        for (let i=0; i<res.data.length; i++)
                        {
                            this.itemsTicketsFacturar.push(res.data[0])
                        }
                        for(let i=0; i<this.itemsTicketsFacturar.length; i++)
                        {
                            this.factura.total = item.IMPORTE
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
                }
                else if(item.LIQUIDACION == 1 && this.itemsTicketsFacturar.length > 0)
                {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Imposible Agregar!',
                        text: 'El ticket es una liquidacion',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                else if(this.itemsTicketsFacturar.length == 0)
                {
                    this.itemsTicketsFacturar.push(item)
                    this.factura.total = item.IMPORTE
                }
                else
                {
                    if(this.itemsTicketsFacturar[0].LIQUIDACION)
                    {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Imposible Agregar!',
                            text: 'Tienes un ticket de liquidacion seleccionado',
                            showConfirmButton: false,
                            timer: 3000
                    })
                    }
                    else
                    {
                        for (let i=0; i<this.itemsTicketsFacturar.length; i++)
                        {
                            if(this.itemsTicketsFacturar[i].ID == item.ID)
                            {
                                Swal.fire({
                                    icon: 'warning',
                                    title: '¡Ticket selecionado!',
                                    text: 'El ticket ya se encuentra para facturar',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                                status = true
                                break;
                            }
                        }
                        if(status == false)
                            this.itemsTicketsFacturar.push(item);
                        this.factura.total = 0
                        for(let i=0; i<this.itemsTicketsFacturar.length; i++)
                        {
                            this.factura.total = this.factura.total + this.itemsTicketsFacturar[i].IMPORTE
                        }
                    }
                }
            },
            deselectTicket(idItem)
            {
                console.log(this.itemsTicketsFacturar)
                if(this.itemsTicketsFacturar[0].LIQUIDACION == 1 && this.itemsTicketsFacturar[1].ANTICIPO == 1)
                {
                    this.itemsTicketsFacturar = []
                }
                const index = this.itemsTicketsFacturar.findIndex( x => x.ID === idItem );
                this.itemsTicketsFacturar.splice( index, 1 );
                this.factura.total = 0
                for(let i=0; i<this.itemsTicketsFacturar.length; i++)
                {
                    this.factura.total = this.factura.total + this.itemsTicketsFacturar[i].IMPORTE
                }
            },
            cleanInputs()
            {
                this.inputsDisabled = false
                this.fechaInputs()
                this.sinCliente()
                this.value.sucursal = 0
                this.value.formaPago = 0

                this.factura.nombre = ''
                this.factura.total = 0
                this.factura.usoCfdi = null

                this.itemsTickets = []
                this.itemsTicketsFacturar = []
            }
        }
    }
</script>

<style>
table {
    display: flex;
    flex-flow: column;
    width: 100%;
}

thead {
    flex: 0 0 auto;
}

tbody {
    flex: 1 1 auto;
    display: block;
    overflow-y: auto;
    overflow-x: hidden;
}

tr {
    width: 100%;
    display: table;
    table-layout: fixed;
}

</style>