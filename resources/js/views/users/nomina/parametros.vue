<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">Parametros de Asistencia</div>
                    <div class="card-body">
                        <form>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                            <label for="inputDepartamento">Departamento</label>
                            <select id="inputDepartamento" class="form-control" v-model="value.departamento" @change="Puesto">
                                <option v-for="(item, index) in itemsDepartamento" :value="item.id" :key="index">{{ item.descripcion }}</option>
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputPuesto">Puesto</label>
                            <select id="inputPuesto" class="form-control" v-model="value.puesto" @change="Empleado">
                                <option v-for="(item, index) in itemsPuesto" :value="item.id" :key="index">{{ item.descripcion }}</option>
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputSucursal">Sucursal</label>
                            <select id="inputSucursal" class="form-control" v-model="value.sucursal">
                                <option v-for="(item, index) in itemsSucursal" :value="item.id" :key="index">{{ item.descripcion }}</option>
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputEmpleado">Trabajador</label>
                            <select id="inputEmpleado" class="form-control" v-model="value.empleado">
                                <option v-for="(item, index) in itemsEmpleado" :value="item.nip" :key="index">{{ item.nombre }}</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                            <label for="inputHoraEntrada">Hora de entrada</label>
                            <input type="time" class="form-control" id="inputHoraEntrada" v-model="value.horaEntrada">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputHoraSalida">Hora de salida</label>
                            <input type="time" class="form-control" id="inputHoraSalida" v-model="value.horaSalida">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputEntradaIntermedia">Hora de entrada intermedia</label>
                            <input type="time" class="form-control" id="inputEntradaIntermedia" v-model="value.entradaIntermedia">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputSalidaIntermedia">Hora de salida intermedia</label>
                            <input type="time" class="form-control" id="inputSalidaIntermedia" v-model="value.salidaIntermedia">
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>-->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                            <label for="inputTolerancia">Minutos de tolerancia</label>
                            <input type="number" class="form-control" id="inputTolerancia" v-model="value.tolerancia">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputToleranciaFalta">Minutos de tolerancia para falta</label>
                            <input type="number" class="form-control" id="inputToleranciaFalta" v-model="value.toleranciaFalta">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputRetardos">Retardos para falta</label>
                            <input type="number" class="form-control" id="inputRetardos" v-model="value.retardos">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="inputDescuento">Faltas para descuento</label>
                            <input type="number" class="form-control" id="inputDescuento" v-model="value.descuento">
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" v-model="value.corrido">
                            <label class="form-check-label" for="gridCheck">
                                Horario corrido
                            </label>
                            </div>
                        </div>
                        </form>
                        <button type="submit" class="btn btn-primary" @click="registrar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getDepartamento } from "../../../network/libs/gets/gets.js";
import { getPuesto } from "../../../network/libs/gets/gets.js";
import { getEmpleado } from "../../../network/libs/gets/gets.js";
import { registerParametros } from "../../../network/libs/nomina/nomina.js";
export default {
  data() {
    return {
        itemsSucursal: [],
        itemsDepartamento: [],
        itemsPuesto: [],
        itemsEmpleado: [],
        username: "12345",
        value: {
            departamento: 0,
            puesto: 0,
            sucursal: 0,
            empleado: 0,
            horaEntrada: '',
            horaSalida: '',
            entradaIntermedia: '',
            salidaIntermedia: '',
            tolerancia: 0,
            toleranciaFalta: 0,
            retardos: 0,
            descuento: 0,
            corrido: 0,
            status: 1
        }
    };
  },
  mounted() {
      this.Sucursal();
      this.Departamento();
      this.Empleado();
  },
  methods: {
    registrar()
    {
        registerParametros(this.value).then((res) => {
            if(res.data){
                Swal.fire({
                icon: 'success',
                title: '¡Parametros Guardados!',
                showConfirmButton: false,
                timer: 2500
                })
            this.cleanInputs()
            }
            else{
                Swal.fire({
                icon: 'error',
                title: '¡Ya existe un parametro con ese puesto y empleado!',
                showConfirmButton: false,
                timer: 2500
                })
            }
    })
    .catch((err) => {
        alert(err.response.status) 
    });
    },
    cleanInputs(){
        this.value.departamento = 0,
        this.value.puesto = 0,
        this.value.sucursal = 0,
        this.value.empleado = 0,
        this.value.horaEntrada = '';
        this.value.horaSalida = '';
        this.value.entradaIntermedia = '';
        this.value.salidaIntermedia = '';
        this.value.tolerancia = 0,
        this.value.toleranciaFalta = 0,
        this.value.retardos = 0,
        this.value.descuento = 0,
        this.value.corrido = 0,
        this.value.status = 1
    },
    Sucursal() {
        getSucursal().then((response) => {
            this.itemsSucursal = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    Departamento() {
        getDepartamento().then((response) => {
            this.itemsDepartamento = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    Puesto() {
        this.itemsPuesto = []
        this.itemsEmpleado = []
        getPuesto(this.value.departamento).then((response) => {
            this.itemsPuesto = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    Empleado() {
        this.itemsEmpleado = []
        getEmpleado(this.value.puesto).then((response) => {
            this.itemsEmpleado = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    }
   
  },
};
</script>
