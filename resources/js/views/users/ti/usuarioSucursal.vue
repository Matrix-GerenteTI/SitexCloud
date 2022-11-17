<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Usuario Sucursal</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-5 text-center">
                                    <label for="labelSucursal">Empleado</label>
                                    <select id="inputSucursal" class="form-control" v-model="empleado" @change="getNameUser()">
                                        <option v-for="(item, index) in itemsUsuario" :value="item" :key="index">{{ item.nombre }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 text-center">
                                    <label for="inputNombre">Usuario</label>
                                    <input type="text" class="form-control" id="inputNombre" disabled v-model="empleado.username">
                                </div>
                                <div class="form-group col-md-3 align-self-center"> 
                                    <div class="form-row justify-content-center">
                                        <button type="button" class="btn btn-success btn-lg" @click="guardar">Añadir</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label>Lista de sucursales (mantenga presionada la tecla Ctrl para seleccionar más de una sucursal):</label>
                                <select multiple class="form-control" :size="sizeSucursal" v-model="sucursales">
                                    <option v-for="(item, index) in itemsSucursal" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Registros de usuarios a Sucursales</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="inputSucursal">Empelado</label>
                                <select id="inputSucursal" class="form-control" v-model="usuario" @change="getRegistrosUsuarioSucursal">
                                    <option value="TODOS">TODOS</option>
                                    <option v-for="(item, index) in itemsFiltroUsuario" :value="item.username" :key="index">{{ item.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Sucursal</th>
                                            <th>
                                                <div class="row justify-content-center">
                                                Acciones</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsSucursalesUsuario" :key="i">
                                            <td>{{ item.username }}</td>
                                            <td>{{ item.descripcion }}</td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <button class="btn btn-success mr-2" type="button" @click="editar(item)">
                                                        <i class="fas fa-edit" style="font-size: 15px"></i>
                                                    </button>
                                                    <button class="btn btn-danger mr-2" type="button" @click="borrar(item)">
                                                        <i class="fas fa-trash-alt" style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal" id="modalUsuarioSucursal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Selecciona la nueva sucursal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <label for="inputFamilia">Sucursal*</label>
                                            <select id="inputAlmacen" class="form-control" v-model="newSucursal">
                                                <option v-for="(item, index) in itemsSucursal" :value="item.id" :key="index">
                                                    {{ item.descripcion }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateUsuarioSucursal">Actualizar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getUsuarios } from "../../../network/libs/gets/gets.js";
import { saveUsuarioSucursal } from "../../../network/libs/sistema/sistemas.js";
import { getRegistrosUsuarioSucursal } from "../../../network/libs/gets/gets.js";
import { deleteUsuarioSucursal } from "../../../network/libs/sistema/sistemas.js";
import { updateUsuarioSucursal } from "../../../network/libs/sistema/sistemas.js";

export default {
    data() {
        return {
            empleado: [],
            itemsUsuario: [],
            itemsSucursal: [],
            sizeSucursal: 0,
            sucursales: [],
            usuario: 'TODOS',
            itemsFiltroUsuario: [],
            itemsSucursalesUsuario: [],
            value: {
                sucursal: 0,
                username: null,
            },
            res: false,
            newSucursal: 0,
            username: 0
        }
    },
    mounted() {
        this.getSucursal()
        this.getUsuarios()
        this.getRegistrosUsuarioSucursal()
    },
    methods: {
        getNameUser()
        {
            this.value.username = this.empleado.username
        },
        getUsuarios()
        {
            getUsuarios().then((response) => {
                this.itemsUsuario = response.data
                this.itemsFiltroUsuario = response.data
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getSucursal()
        {
            getSucursal().then((response) => {
                this.itemsSucursal = response.data;
                this.sizeSucursal = this.itemsSucursal.length
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getRegistrosUsuarioSucursal()
        {
            getRegistrosUsuarioSucursal(this.usuario).then((response) => {
                this.itemsSucursalesUsuario = response.data
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        editar(item)
        {
            this.username = item.username
            $('#modalUsuarioSucursal').modal('toggle') 
        },
        updateUsuarioSucursal()
        {
            let data = {
                idSucursal: this.newSucursal,
                username: this.username
            }
            updateUsuarioSucursal(data).then((response) => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro Actualizado!',
                    text: 'Se ha actualizado la sucursal',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.getRegistrosUsuarioSucursal()
                this.newSucursal = 0

                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        borrar(item)
        {
            Swal.fire({
                title: '¿Estás seguro de eliminar el registro del usuario',
                text: "¡No podrás revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteUsuarioSucursal(item.id).then((response) => {
                        console.log(response.data)
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro Eliminado!',
                            text: 'Se ha eliminado este registro',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.getRegistrosUsuarioSucursal()
                        })
                        .catch((err) => {
                            alert(err.response.status)
                    });
                }
            })
        },
        async guardar()
        { 
            if(this.sucursales.length == 0)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Sin sucursal!',
                    text: 'Selecciona al menos una sucursal',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            else if(this.value.username == null)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Sin Usuario!',
                    text: 'Selecciona un usuario',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            else
            {
                for(let i = 0; i<this.sucursales.length; i++) 
                {
                    this.value.sucursal = this.sucursales[i]
                    await saveUsuarioSucursal(this.value).then((response) => {
                        this.res = response.data
                    })
                    .catch((err) => {
                        alert(err.response.status)
                    });
                }
                if(this.res == true)
                {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        text: 'Se han añadido las sucursales',
                        showConfirmButton: false,
                        timer: 1500
                    })
                this.getRegistrosUsuarioSucursal()
                this.cleanInputs()
                this.res = false
                }
            }
        },
        cleanInputs()
        {
            this.empleado = []
            this.value.sucursal = 0
            this.value.username = null
            this.sucursales = []
        }

    }
}
</script>
