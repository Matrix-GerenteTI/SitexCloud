<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Nueva Excepción</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputFechaNacimiento">Fecha de excepcion</label>
                                    <input type="date" class="form-control" id="inputFechaNacimiento" v-model="value.fecha">
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="inputNombre">Causa</label>
                                    <input type="text" class="form-control text-uppercase" id="inputNombre" v-model="value.causa">
                                </div>
                                <div class="form-group col-md-2 align-self-center"> 
                                    <div class="form-row justify-content-center">
                                        <button type="button" class="btn btn-primary" @click="guardar">Registrar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label>Lista de sucursales (mantenga presionada la tecla Ctrl para seleccionar más de una sucursal):</label>
                                <select multiple class="form-control" :size="sizeSucursal" v-model="sucursales">
                                    <option v-for="(item, index) in itemsSucursal" :value="item.idprediction" :key="index">{{ item.descripcion }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Excepciones</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <label for="inputSucursal">Sucursal</label>
                                <select id="inputSucursal" class="form-control" v-model="idAlmacen" @change="getRegistrosExcepciones">
                                    <option v-for="(item, index) in itemsSucursal" :value="item.idprediction" :key="index">{{ item.descripcion }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Sucursal</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Causa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in itemsRegistrosExcepciones" :key="i">
                                            <th scope="row" >{{ item.descripcion }}</th>
                                            <td>{{ item.fecha }}</td>
                                            <td>{{ item.causa }}</td>
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
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { guardarExcepcion } from "../../../network/libs/sistema/sistemas.js";
import { getRegistrosExcepciones } from "../../../network/libs/sistema/sistemas.js";

export default {
    data() {
        return {
            itemsSucursal: [],
            sizeSucursal: 0,
            sucursales: [],
            idAlmacen: 0,
            itemsRegistrosExcepciones: [],
            value: {
                sucursal: 0,
                fecha: null,
                causa: ''
            },
            res: false
        }
    },
    mounted() {
        this.getSucursal()
    },
    methods: {
        getSucursal()
        {
            getSucursal().then((response) => {
                this.itemsSucursal = response.data;
                console.log(this.itemsSucursal)
                this.sizeSucursal = this.itemsSucursal.length
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getRegistrosExcepciones()
        {
            getRegistrosExcepciones(this.idAlmacen).then((response) => {
                this.itemsRegistrosExcepciones = response.data
                this.itemsRegistrosExcepciones.reverse();
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        async guardar()
        {
            for(let i = 0; i<this.sucursales.length; i++) 
            {
                this.value.sucursal = this.sucursales[i]
                await guardarExcepcion(this.value).then((response) => {
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
                text: 'Se ha registrado la excepcion',
                showConfirmButton: false,
                timer: 1500
            })
            this.cleanInputs()
            this.res = false
            this.getRegistrosExcepciones()
            }
        },
        cleanInputs()
        {
            this.value.sucursal = 0
            this.value.fecha = null
            this.value.causa= ''
            this.sucursales = []
        }

    }
}
</script>
