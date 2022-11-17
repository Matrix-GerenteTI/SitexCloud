<template>
    <div class="row mx-2">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Pedido</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
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
                                    <label for="inputFamilia">Tipo de venta*</label>
                                    <select id="inputPago" class="form-control" v-model="value.tipoVenta">
                                        <option v-for="(item, index) in itemsTipoVenta" :value="item.id" :key="index">
                                            {{ item.descripcion }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                    <label for="inputFechaNacimiento">Folio</label>
                                    <input type="text" class="form-control" id="inputfecha" v-model="folioTicket">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <label for="inputFamilia">Almacen*</label>
                                    <select id="inputAlmacen" class="form-control" v-model="value.sucursal">
                                        <option v-for="(item, index) in itemsSucursal" :value="item.idprediction" :key="index">
                                            {{ item.descripcion }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <label for="inputFechaNacimiento">Fecha*</label>
                                    <input type="date" class="form-control" id="inputfecha" v-model="value.fecha">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <label for="inputFamilia">Tipo de Ticket*</label>
                                    <select id="inputAlmacen" class="form-control" v-model="value.tipoTicket">
                                        <option v-for="(item, index) in itemsTipoTicket" :value="item.id" :key="index">
                                            {{ item.descripcion }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <label for="inputMarca">Marca*</label>
                                    <select id="inputMarca" class="form-control" v-model="value.marca" @change="getLineaAuto">
                                        <option v-for="(item, index) in itemsMarca" :value="item.id" :key="index">{{ item.marca }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <label for="inputMarca">Linea*</label>
                                    <select id="inputMarca" class="form-control" v-model="value.linea">
                                        <option v-for="(item, index) in itemsLinea" :value="item.id" :key="index">{{ item.modelo }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                    <label for="inputMarca">Color*</label>
                                    <input type="text" class="form-control text-uppercase" id="inputVendedor" v-model="value.color">
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead style="font-size: 12px;">
                                            <tr>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 14%;">Codigo</th>
                                            <th style="width: 36%;">Descripcion</th>
                                            <th style="width: 8%;">Precio</th>
                                            <th style="width: 7%;">Cant</th>
                                            <th style="width: 7%;">Impor</th>
                                            <th style="width: 7%;">Desc</th>
                                            <th style="width: 7%;">Total</th>
                                            <th style="width: 9%;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <div style="height: 325px;overflow: scroll;">
                                            <tbody style="font-size: 10px;">
                                                <tr v-for="(item, i) in itemsProductos" :key="i">
                                                    <th style="width: 5%;">{{ i+1 }}</th>
                                                    <th style="width: 14%;">{{ item.codigo }}</th>
                                                    <th style="width: 40%;">{{ item.nombre }}</th>
                                                    <th style="width: 8%;">{{ item.precioUnitario }}</th>
                                                    <th style="width: 7%;">{{ item.cantidad }}</th>
                                                    <th style="width: 7%;">{{ item.importe }}</th>
                                                    <th style="width: 7%;">{{ item.descuento }}</th>
                                                    <th style="width: 7%;">{{ item.total }}</th>
                                                    <td style="width: 9%;">
                                                        <button class="btn btn-danger mr-2" type="button" @click="borrarProducto(i)">
                                                            <i class="fas fa-trash-alt" style="font-size: 15px"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </div>
                                    </table>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                    <div class="row">
                                        <label>Observaciones</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                                    <div class="row my-1">
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
                                            <button type="button" class="btn btn-block btn-success">PAGAR</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                            <button class="btn btn-primary mr-2" type="button">
                                                <i class="fas fa-file" style="font-size: 30px"></i>
                                            </button>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                            <button class="btn btn-primary mr-2" type="button">
                                                <i class="fas fa-file-invoice-dollar" style="font-size: 30px"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                            <button type="button" class="btn btn-block btn-danger">CANCELAR</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                            <button class="btn btn-primary mr-2" type="button">
                                                <i class="fas fa-print" style="font-size: 30px"></i>
                                            </button>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                            <button class="btn btn-primary mr-2" type="button">
                                                <i class="fas fa-save" style="font-size: 30px"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-3">
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-6 col-md-6 col-lg-7">
                                            <div class="row">
                                                <div class="col">
                                                    Subtotal
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    Descuento
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    Imp. Ret.
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    Imp. Tras.
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    Total
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-6 col-md-6 col-lg-3">
                                            <div class="row">
                                                ${{this.subtotal}}
                                            </div>
                                            <div class="row">
                                                ${{this.descuento}}
                                            </div>
                                            <div class="row">
                                                ${{this.impRet}}
                                            </div>
                                            <div class="row">
                                                ${{this.impTras}}
                                            </div>
                                            <div class="row">
                                                ${{this.total}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                        </div>
                        
                        <div class="col-4 border-left">
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="inputNombre">Buscar producto*</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-uppercase" id="inputCliente" v-model="value.nameProducto" v-on:keyup.13="getNameProducto">
                                        <div class="input-group-append">
                                            <button id="show_confirmpassword" class="btn btn-light" type="button" data-toggle="modal" data-target="#exampleModal" @click="getNameProducto">
                                            <span class="fas fa-search"></span> </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Buscar Producto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-striped table-hover" data-dismiss="modal">
                                                            <thead>
                                                                <tr>
                                                                    <th>Codigo</th>
                                                                    <th>Descripcion</th>
                                                                    <th>Familia</th>
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
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="custom-file">
                                                <div class="form-row justify-content-center">
                                                    <img id="frameProducto" src="../../../../../resources/img/camara.png" class="rounded img-fluid">
                                                    <input type="file"  class="custom-file-input" id="takePhoto" style="display: none">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-row">
                                                <span>
                                                    Exist: 3
                                                </span>
                                            </div>
                                            <div class="form-row">
                                                <span>
                                                    PALMERAS [1]
                                                </span>
                                            </div>
                                            <div class="form-row">
                                                <span>
                                                    LAURELES [1]
                                                </span>
                                            </div>
                                            <div class="form-row">
                                                <span>
                                                    LIBRAMIENTO [1]
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                                    <!--<div class="form-row">
                                        <div class="form-group col-12 text-center">
                                            <Span for="inputNIP">DESCRIPCION</Span>
                                        </div>
                                    </div>-->
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <span>{{this.nameProducto}}</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 align-self-center">
                                            <div class="form-row justify-content-center">
                                                <span>PRECIO</span>
                                            </div>
                                        </div>
                                        <div v-if="this.ingresaPrecio != 99" class="form-group col-md-8">
                                            <select id="inputMarca" class="form-control" v-model="ingresaPrecio">
                                                <option value="Ppvp1">$2,000.00</option>
                                                <option value="99">Otro</option>
                                            </select>
                                        </div>
                                        <div v-if="this.ingresaPrecio == 99" class="form-group col-md-8">
                                            <div class="input-group">
                                                <input type="number" class="form-control" placeholder="0" id="inputNSS" v-model="inputPrecio">
                                                <div class="input-group-append">
                                                    <button id="show_confirmpassword" class="btn btn-light" type="button" @click="setSelect">
                                                    <span class="fas fa-undo"></span> </button>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 align-self-center">
                                            <div class="form-row justify-content-center">
                                                <span>DESC</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <input type="number" class="form-control" placeholder="0" id="inputNSS" v-model="inputDescuento">
                                        </div>   
                                    </div>
                                    <div class="form-row">
                                        <div class="col-7">
                                            <input type="number" class="form-control" id="inputNSS" v-model="inputCantidad">
                                        </div>
                                        <div class="col-5">
                                            <button type="button" class="btn btn-primary" @click="addProducto">Agregar</button>
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
</template>

<script>
import Swal from 'sweetalert2'
import { getNameCliente } from "../../../network/libs/gets/gets.js";
import { getTipoVenta } from "../../../network/libs/gets/gets.js";
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getTipoTicket } from "../../../network/libs/gets/gets.js";
import { getMarca } from "../../../network/libs/gets/gets.js";
import { getLinea } from "../../../network/libs/gets/gets.js";

    export default {
        data() {
            return {
                nameProducto: "195/60/14  MAXXIS MOD.ESCAPADE MA-T1 C. N. 86T",
                inputPrecio: null,
                inputCantidad: 1,
                inputDescuento: null,

                inputsDisabled: false,
                folioTicket: null,
                ingresaPrecio: 0,

                subtotal: 0,
                descuento: 0,
                impRet: 0,
                impTras: 0,
                total: 0,

                itemsClientes: [],
                itemsTipoVenta: [],
                itemsSucursal: [],
                itemsTipoTicket: [],
                itemsProductos: [],
                itemsMarca: [],
                itemsLinea: [],
                value:{
                    idCliente : 0,
                    nameCliente: '',
                    tipoVenta: 1,
                    sucursal: 0,
                    fecha: null,
                    tipoTicket: 1,
                    marca: 0,
                    linea: 0,
                    color: '',
                },
            };
        },
        mounted() {
            this.getSelects()
            let date = new Date();
            this.value.fecha = new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
        },
        
        methods:{
            addProducto()
            {
                if(this.inputDescuento == null)
                    this.inputDescuento = 0
                let addProducto = {
                    codigo: "0JN234NJ23",
                    nombre: this.nameProducto,
                    precioUnitario : parseInt(this.inputPrecio),
                    cantidad: parseInt(this.inputCantidad),
                    importe: this.inputPrecio*this.inputCantidad,
                    descuento: parseInt(this.inputDescuento),
                    total: (this.inputPrecio*this.inputCantidad)-this.inputDescuento,
                }
                this.itemsProductos.push(addProducto)
                this.calculos()
            },
            borrarProducto(i)
            {
                this.itemsProductos.splice(i,1)
                this.calculos()
            },
            calculos()
            {
                this.total = 0
                this.subtotal = 0
                this.descuento = 0
                for(let i=0; i<this.itemsProductos.length; i++)
                {
                    this.subtotal = this.subtotal + this.itemsProductos[i].importe
                    this.descuento = this.descuento + this.itemsProductos[i].descuento
                    this.total = this.total + this.itemsProductos[i].total
                }
            },
            getSelects()
            {
                getTipoVenta().then((res) => {
                    this.itemsTipoVenta = res.data
                })
                .catch((err) => {
                    console.log(err);
                });   
                getSucursal().then((response) => {
                    this.itemsSucursal = response.data;
                })
                .catch((err) => {
                    alert(err.response.status);
                });
                getTipoTicket().then((response) => {
                    this.itemsTipoTicket = response.data;
                })
                .catch((err) => {
                    alert(err.response.status);
                });
                getMarca().then((response) => {
                    this.itemsMarca = response.data;
                    })
                    .catch((err) => {
                        alert(err.response.status)
                });
            },
            getLineaAuto() {
                getLinea(this.value.marca).then((response) => {
                    this.itemsLinea = response.data;
                    })
                    .catch((err) => {
                        alert(err.response.status)
                });

            },
            sinCliente()
            {
                this.value.nameCliente = ''
                this.value.idCliente = 0
                document.getElementById('inputCliente').style.background='#FFFFFF';
            },
            setSelect()
            {
                this.ingresaPrecio = 0
            },
            getNameCliente() 
            {
                $('#exampleModalCenter').modal('toggle')
                this.value.nameCliente = this.value.nameCliente.toUpperCase();
                getNameCliente(this.value.nameCliente).then((res) => {
                    this.itemsClientes = res.data
                })
                .catch((err) => {
                    console.log(err);
                });
            },
            selectEmpleado(cliente)
            {
                this.value.nameCliente = cliente.NOMBRE
                this.value.idCliente = cliente.ID
                document.getElementById('inputCliente').style.background='#FFFF33';
            },
            getNameProducto()
            {

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