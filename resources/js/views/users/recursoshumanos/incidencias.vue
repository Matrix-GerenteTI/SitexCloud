<template>
    <div class="row mx-2">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Percepciones y/o Deducciones</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                        <label for="inputNombre">Empleado*</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-uppercase" id="inputNombre" v-model="value.nombre" disabled>
                                            <div class="input-group-append">
                                                <button id="show_confirmpassword" class="btn btn-light" type="button" data-toggle="modal" data-target="#exampleModalCenter" @click="getEmpleadosAll">
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
                                                                        <td scope="row" @click="selectEmpleado(item)">{{ item.nombre  }}</td>
                                                                        <td @click="selectEmpleado(item)">{{ item.descripcion  }}</td>
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
                                    <label for="inputFamilia">Tipo de Movimiento*</label>
                                    <select id="inputFamilia" class="form-control" v-model="value.idTipoMovimiento" @change="getAccionIncidencias">
                                        <option v-for="(item, index) in itemsTipo" :key="index" :value="item.id">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                    <label for="inputFamilia">Accion*</label>
                                    <select id="inputFamilia" class="form-control" v-model="value.idincidencia"> 
                                        <option v-for="(item, index) in itemsAccion" :key="index" :value="item.id">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                    <label for="inputFechaNacimiento">Fecha incidencia*</label>
                                    <input type="date" class="form-control" id="inputFecha" v-model="value.fechaIncidencia">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                                    <label for="inputFechaNacimiento">Monto*</label>
                                    <input type="number" class="form-control" id="inputMonto" placeholder="$0.00" v-model="value.monto">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                    <label for="inputFamilia">Parcialidades*</label>
                                    <select id="inputFamilia" class="form-control" v-model="value.parcialidades" @change="setPagos">
                                        <option value="1">Una exhibición</option>
                                        <option value="2">Diferido</option>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                    <label for="inputFechaNacimiento">Fecha a aplicar*</label>
                                    <input type="date" class="form-control" id="inputFecha" v-model="value.fechaAplicar">
                                </div>
                                <div v-if="this.value.parcialidades == 2" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-1">
                                    <label for="inputFechaNacimiento"># pagos*</label>
                                    <input type="number" class="form-control" id="inputMonto" placeholder="0" v-model="value.cantidadPagos">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="inputFechaNacimiento">Observaciones</label>
                                    <input type="text" class="form-control" id="inputMonto" v-model="value.observaciones">
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3 float-right my-2">
                            <button type="button" class="btn btn-success btn-lg btn-block" @click="guardarIncidencia">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Ver Incidencias</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <label for="inputSucursal">Tipo de Incidencia</label>
                                <select id="inputSucursal" class="form-control" v-model="filtroIncidencia" @change="filtroIncidencias">
                                    <option v-for="(item, index) in itemsTipo" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Empleado</th>
                                        <th scope="col">Incidencia</th>
                                        <th scope="col">fecha</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col"># Pagos</th>
                                        <th scope="col">Observaciones</th>
                                        <th scope="col">Status</th>
                                        <th class="row justify-content-md-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsAllIncidencias" :key="i">
                                            <th scope="row" >{{ item.nombre }}</th>
                                            <td>{{ item.descripcion }}</td>
                                            <td>{{ item.fecha }}</td>
                                            <td>${{ item.monto }}</td>
                                            <td>{{ item.numpagos }}</td>
                                            <td>{{ item.observaciones }}</td>
                                            <td v-if="item.status == 0">
                                                <h4><span class="badge badge-warning">Pendiente</span></h4>
                                            </td>
                                            <td v-if="item.status == 1">
                                                <h4><span class="badge badge-success">Aceptado</span></h4>
                                            </td>
                                            <td v-if="item.status == 2">
                                                <h4><span class="badge badge-secondary">Modificado</span></h4>
                                            </td>
                                            <td v-if="item.status == 99">
                                                <h4><span class="badge badge-danger">Cancelado</span></h4>
                                            </td>
                                            <td>
                                                <div v-if="item.status != 99" class="row justify-content-center">
                                                        <button v-if="item.status != 0" class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#ModalPagos" @click="verPagos(item)">
                                                            <i class="fas fa-eye" style="font-size: 15px"></i>
                                                        </button>
                                                 
                                                        <button class="btn btn-success mr-2" type="button" @click="editarPrecio(i, item)">
                                                            <i class="fas fa-edit" style="font-size: 15px"></i>
                                                        </button>
                                                    
                                                        <button class="btn btn-danger mr-2" type="button" @click="borrarIncidencia(item)">
                                                            <i class="fas fa-trash-alt" style="font-size: 15px"></i>
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
                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Pagos</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-hover" data-dismiss="modal">
                                                <thead>
                                                    <tr>
                                                        <th># Pago</th>
                                                        <th>Monto</th>
                                                        <th>Fecha de Pago</th>
                                                        <th>Empleado</th>
                                                        <th>Monto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item,i) in itemsPagos" :key="i">
                                                        <td scope="row">{{ i+1  }}</td>
                                                        <td>{{ item.monto  }}</td>
                                                        <td>{{ item.fechadepago  }}</td>
                                                        <td>{{ item.empleadoquepago  }}</td>
                                                        <td>{{ item.fechapagado  }}</td>
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
            </div>
        </div>
</template>

<script>
import Swal from 'sweetalert2'
import { getUser } from "../../../network/libs/user/user.js";
import { getTipoIncidencia } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getAccionIncidenciasPorUsuario } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getDepartamento } from "../../../network/libs/gets/gets.js";
import { getEmpleadosAll } from "../../../network/libs/gets/gets.js";
import { guardarIncidencia } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { borrarIncidencia } from "../../../network/libs/recursoshumanos/recursoshumanos.js";


import { getAllDeducciones } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getAllPercepciones } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getPagos } from "../../../network/libs/recursoshumanos/recursoshumanos.js";

export default {
    data() {
        return {
            user: '',
            itemsTipo: [],
            itemsAccion: [],
            value:{
                idempleado: 0,
                idTipoMovimiento: 0,
                idincidencia: 0,
                nombre: '',
                fechaIncidencia: null,
                monto: null,
                parcialidades: null,
                fechaAplicar: null,
                cantidadPagos: null,
                observaciones: ''
            },
            departamentoSearch:'TODOS',
            itemsDepartamento: [],
            nameEmpleado: '',
            itemsAllEmpleados: [],

            filtroIncidencia: 1,
            itemsAllIncidencias: [],
            itemsPagos: []
        }
    },
    mounted() {
        this.getUser()
        this.getTiposIncidencias()
        getDepartamento().then((response) => {
            this.itemsDepartamento = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        this.getAllDeducciones()
    },

    methods: {
        borrarIncidencia(item)
        {
            if(item.status == 0)
            {
                Swal.fire({
                    title: '¿Estás seguro de eliminar la incidencia?',
                    text: "¡No podrás revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if(result.isConfirmed) {
                        borrarIncidencia(item.id).then((response) => {
                            console.log(response.data)
                            Swal.fire({
                                icon: 'success',
                                title: '¡Incidencia Eliminada!',
                                text: 'Se ha eliminado la incidencia',
                                showConfirmButton: false,
                                timer: 1500
                                })
                            this.filtroIncidencias()
                            })
                            .catch((err) => {
                                alert(err.response.status)
                        });
                    }
                })
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: '¡Imposible Borrar!',
                    text: 'La incidencia ya fue aceptada por dirección',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        },
        editarPrecio(i, item)
        {
            if(item.status == 0)
            {
                console.log("Se puede editar")
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: '¡Imposible Editar!',
                    text: 'La incidencia ya fue aceptada por dirección',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        },
        verPagos(item)
        {
            console.log(item)
            getPagos(item.id).then((response) => {
            this.itemsPagos = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        },
        getAllDeducciones()
        {
            getAllDeducciones().then((res) => {
                this.itemsAllIncidencias = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },
        getAllPercepciones()
        {
            getAllPercepciones().then((res) => {
                this.itemsAllIncidencias = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },
        filtroIncidencias()
        {
            if(this.filtroIncidencia == 1)
                this.getAllDeducciones()
            else if(this.filtroIncidencia == 2)
                this.getAllPercepciones()
        },
        getUser(){
            getUser().then((res) => {
                this.user = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },
        getTiposIncidencias()
        {
            getTipoIncidencia().then((res) => {
                this.itemsTipo = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },
        getAccionIncidencias()
        {
            let array = {
               idTipoMovimiento: this.value.idTipoMovimiento,
               idEmpleado: this.user.idempleado
            }
            getAccionIncidenciasPorUsuario(array).then((res) => {
                this.itemsAccion = res.data
            })
            .catch((err) => {
                console.log(err);
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
        selectEmpleado(item)
        {
            this.value.nombre = item.nombre
            this.value.idempleado = item.nip
        },
        setPagos()
        {
            this.value.parcialidades = parseInt(this.value.parcialidades)
            console.log(this.value.parcialidades)
            if(this.value.parcialidades == 1)
                this.value.cantidadPagos = 1
            else
                this.value.cantidadPagos = null

            
        },
        guardarIncidencia()
        {
            if(this.value.idempleado == 0 || this.value.idTipoMovimiento == 0 || this.value.idincidencia == 0 || this.value.parcialidades == null)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Faltan Campos!',
                    text: 'Completa todos los campos',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            else if(this.value.fechaIncidencia == null || this.value.fechaAplicar == null)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Fechas Nulas!',
                    text: 'Ingresa las fechas correctas',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            else if(this.value.parcialidades == 2 && this.value.cantidadPagos <=0 || this.value.monto <= 0)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Numero de pagos o Monto vacio!',
                    text: 'Ingresa un numero de pagos',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            else
            {
                this.value.cantidadPagos = parseInt(this.value.cantidadPagos)
                guardarIncidencia(this.value).then((response) => {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Incidencia Correcta!',
                        text: 'Se ha registrado correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    this.cleanInputs()
                    if(this.filtroIncidencia == 1)
                        this.getAllDeducciones()
                    else if(this.filtroIncidencia == 2)
                        this.getAllPercepciones()
                })
                .catch((err) => {
                    alert(err.response.status)
                });
            }
        },
        cleanInputs()
        {
            this.value.idempleado = 0,
            this.value.idTipoMovimiento = 0,
            this.value.idincidencia = 0
            this.value.nombre = '',
            this.value.fechaIncidencia = null,
            this.value.monto = null,
            this.value.parcialidades = null,
            this.value.fechaAplicar = null,
            this.value.cantidadPagos = null,
            this.value.observaciones = ''
        }
    }
}
</script>

<style>

</style>