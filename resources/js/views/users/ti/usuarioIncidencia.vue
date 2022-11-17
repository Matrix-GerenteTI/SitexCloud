<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Relacion Empleados - Incidencias</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                        <label for="inputNombre">Empleado</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-uppercase" id="inputNombre" v-model="value.nombre">
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
                                        <label for="inputFamilia">Tipo de Movimiento</label>
                                        <select id="inputFamilia" class="form-control" v-model="value.idTipoMovimiento" @change="getAccionIncidencias">
                                            <option v-for="(item, index) in itemsTipo" :key="index" :value="item.id">{{ item.descripcion }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                        <label for="inputFamilia">Accion</label>
                                        <select id="inputFamilia" class="form-control" v-model="value.idincidencia">
                                            <option v-for="(item, index) in itemsAccion" :key="index" :value="item.id">{{ item.descripcion }}</option>
                                        </select>
                                    </div>
                            </div>
                        </form>
                        <div class="col-md-3 float-right my-2">
                            <button type="button" class="btn btn-success btn-lg btn-block" @click="save">Registrar</button>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsIncidencias" :key="i">
                                            <th scope="row" >{{ item.nombre }}</th>
                                            <td>{{ item.descripcion }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
import { getTipoIncidencia } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getAccionIncidencias } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getDepartamento } from "../../../network/libs/gets/gets.js";
import { getEmpleadosAll } from "../../../network/libs/gets/gets.js";
import { saveUsuarioIncidencia } from "../../../network/libs/sistema/sistemas.js";

import { getDeduccionesEmpleado } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getPercepcionesEmpleado } from "../../../network/libs/recursoshumanos/recursoshumanos.js";

export default {
    data() {
        return {
            itemsTipo: [],
            itemsAccion: [],
            value:{
                idTipoMovimiento: 0,
                nombre: '',
                idempleado: 0,
                idincidencia: 0
            },
            departamentoSearch:'TODOS',
            itemsDepartamento: [],
            nameEmpleado: '',
            itemsAllEmpleados: [],

            filtroIncidencia: 1,
            itemsIncidencias: []
        }
    },
    mounted() {
        this.getTiposIncidencias()
        getDepartamento().then((response) => {
            this.itemsDepartamento = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
        this.getDeduccionesEmpleado()
    },

    methods: {
        filtroIncidencias()
        {
            if(this.filtroIncidencia == 1)
                this.getDeduccionesEmpleado()
            else if(this.filtroIncidencia == 2)
                this.getPercepcionesEmpleado()
        },
        getDeduccionesEmpleado()
        {
            getDeduccionesEmpleado().then((res) => {
                this.itemsIncidencias = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },
        getPercepcionesEmpleado()
        {
            getPercepcionesEmpleado().then((res) => {
                this.itemsIncidencias = res.data
            })
            .catch((err) => {
                console.log(err);
            });
        },
        save()
        {
            saveUsuarioIncidencia(this.value).then((response) => {
                if(response.data == false)
                {
                    Swal.fire({
                        icon: "error",
                        title: "Ya existe",
                        text: "El usuario ya tiene la incidencia registrada",
                        showConfirmButton: false,
                        timer: 2500,
                    });
                }
                else if (response.data == true)
                {
                    switch(this.value.idTipoMovimiento)
                    {
                        case 1:
                            this.filtroIncidencia = 1
                            this.getDeduccionesEmpleado()
                        break;
                        case 2:
                            this.filtroIncidencia = 2
                            this.getPercepcionesEmpleado()
                        break;
                    }
                    Swal.fire({
                        icon: "success",
                        title: "Registro Exitoso",
                        text: "Se ha guardado correctamente",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    this.cleansInputs()
                }
            })
            .catch((err) => {
                alert(err.response.status)
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
            getAccionIncidencias(this.value.idTipoMovimiento).then((res) => {
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
        cleansInputs()
        {
            this.value.idTipoMovimiento = 0
            this.value.nombre = ''
            this.value.idempleado = 0
            this.value.idincidencia = 0
        }
    }
}
</script>

<style>

</style>