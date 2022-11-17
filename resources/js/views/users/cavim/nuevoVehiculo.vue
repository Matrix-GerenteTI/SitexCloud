<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">Nuevo Vehículo</div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputDepartamento">Marca</label>
                                    <select id="inputDepartamento" class="form-control" v-model="value.marca">
                                        <option v-for="(item, index) in itemsMarca" :value="item.id" :key="index">{{ item.marca }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputNombre">Linea</label>
                                    <input type="text" class="form-control text-uppercase" id="inputNombre" v-model="value.modelo">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="inputRFC">Año</label>
                                    <input type="number" placeholder="1999" class="form-control text-uppercase" id="inputRFC" v-model="value.anio">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCURP">Versión</label>
                                    <input type="text" placeholder="---" class="form-control text-uppercase" id="inputCURP" v-model="value.version">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputNSS">Tipo de carro</label>
                                    <select id="inputDepartamento" class="form-control" v-model="value.tipo">
                                        <option value="Sedán">Sedán</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="Pick Up">Pick Up</option>
                                        <option value="SUV">SUV</option>
                                        <option value="Crossover">Crossover</option>
                                        <option value="Convertible">Convertible</option>
                                        <option value="Sports Car">Sports Car</option>
                                        <option value="Minivan">Minivan</option>
                                        <option value="Camiones">Camiones</option>
                                    </select>
                                </div>    
                            </div>
                        </form>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" @click="guardarVehiculo">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
import { getMarca } from "../../../network/libs/gets/gets.js";
import { guardarVehiculo } from "../../../network/libs/cavim/cavim.js";

export default {
    data() {
        return {
            itemsMarca: [],
            value: {
                marca: 0,
                modelo: '',
                anio: null,
                version: '',
                tipo: ''
            }
        }
    },
    mounted() {
        getMarca().then((response) => {
            this.itemsMarca = response.data;
            })
            .catch((err) => {
                alert(err.response.status)
        });
    },
    methods: {
        guardarVehiculo()
        {
            guardarVehiculo(this.value).then((response) => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Vehículo Guardado!',
                    text: 'Se ha registrado un nuevo vehículo',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.cleanInputs()
            })
            .catch((err) => {
                alert(err.response.status)
            });
        },
        cleanInputs()
        {
            this.value.marca = 0
            this.value.modelo = ''
            this.value.anio = null
            this.value.version = ''
            this.value.tipo = ''
        }
    }
}
</script>
