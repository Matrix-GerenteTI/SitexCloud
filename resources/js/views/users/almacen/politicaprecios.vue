<template>
    <div class="row mx-2">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">Politica de Precios</div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label for="inputFamilia">Familia</label>
                            <select id="inputFamilia" class="form-control" v-model="value.familia" @change="getSubfamilia">
                                <option v-for="(item, index) in itemsFamilia" :key="index">{{ item.name }}</option>
                            </select>
                        </div>
                        <div v-if="this.value.familia != 'LLANTA'" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label for="inputSubfamilia">Subfamilia</label>
                            <select id="inputSubfamilia" class="form-control" v-model="value.subfamilia">
                                <option v-for="(item, index) in itemsSubfamilia" :key="index">{{ item.name }}</option>
                            </select>
                        </div>
                        <div v-if="this.value.familia == 'LLANTA'" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label for="inputSubfamilia">Medida</label>
                            <input v-if="this.value.familia == 'LLANTA'" type="text" placeholder="000/00/00" class="form-control" id="inputLlanta" v-model="value.subfamilia">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputPrecio1">Pvp1</label>
                            <input type="number" placeholder="0" class="form-control" id="inputPrecio1" v-model="value.pvp1">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputPrecio2">Pvp2</label>
                            <input type="number" placeholder="0" class="form-control" id="inputPrecio2" v-model="value.pvp2">
                        </div>
                        <div class="form-group col-md-1">
                                <label for="inputPrecio3">Pvp3</label>
                                <input type="number" placeholder="0" class="form-control" id="inputPrecio3" v-model="value.pvp3">
                        </div>
                        <div class="form-group col-md-1">
                                <label for="inputPrecio4">Pvp4</label>
                                <input type="number" placeholder="0" class="form-control" id="inputPrecio4" v-model="value.pvp4">
                        </div>
                        <div class="form-group col-md-1">
                                <label for="inputPrecio5">Pvp5</label>
                                <input type="number" placeholder="0" class="form-control" id="inputPrecio5" v-model="value.pvp5">
                        </div>
                        <div class="form-group col-md-1">
                            <button class="btn btn-success" type="button" @click="savePrecio">
                                <i class="fas fa-save" style="font-size: 30px"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card my-2">
                <div class="card-header">Precios</div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label for="inputFiltroFamilia">Familia</label>
                            <select id="inputFiltroFamilia" class="form-control" v-model="filtros.filtroFamilia" @change="getFiltroFamilia" :disabled="selectFamilia">
                                <option>TODOS</option>
                                <option v-for="(item, index) in itemsFiltroFamilia" :key="index">{{ item.familia }}</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label v-if="this.filtros.filtroFamilia != 'LLANTA'" for="inputFiltroSubfamilia">Subfamilia</label>
                            <label v-if="this.filtros.filtroFamilia == 'LLANTA'" for="inputFiltroSubfamilia">Medida</label>
                            <select id="inputFiltroSubfamilia" class="form-control" v-model="filtros.filtroSubfamilia" @change="getPrecioPorSubfamilia" :disabled="selectSubFamilia">
                                <option v-for="(item, index) in itemsFiltroSubfamilia" :key="index">{{ item.subfamilia }}</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-6 offset-md-4">
                            <div class="row justify-content-center">
                                <button type="button" class="btn btn-primary" @click="exportarExcel">Exportar Excel</button>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row table-responsive">
                        <table class="table table-striped table-hover" data-dismiss="modal">
                            <thead>
                                <tr>
                                    <th>Familia</th>
                                    <th>Subfamilia</th>
                                    <th>Pvp1</th>
                                    <th>Pvp2</th>
                                    <th>Pvp3</th>
                                    <th>Pvp4</th>
                                    <th>Pvp5</th>
                                    <th class="row justify-content-md-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(itemTabla,i) in itemsPrecios" :key="i">
                                    <!--<td >
                                        <select id="inputFiltroFamilia" class="form-control" v-model="itemTabla.familia" disabled>
                                            <option v-for="(item, index) in itemsFamilia" :key="index">{{ item.name }}</option>
                                        </select>
                                    </td>
                                    <td >
                                        <select id="inputSubfamilia" class="form-control" v-model="itemTabla.subfamilia" disabled>
                                            <option v-for="(item, index) in itemsFiltroSubfamilia" :key="index">{{ item.name }}</option>
                                        </select>
                                    </td>-->
                                    <td >{{ itemTabla.familia }}</td>
                                    <td >{{ itemTabla.subfamilia }}</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="pvp" v-model="itemTabla.pvp1" :disabled="disabledPvp1[i]">
                                        </div>
                                    </td>
                                    <td >
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="inputPrecio3" v-model="itemTabla.pvp2" :disabled="disabledPvp2[i]">
                                        </div>
                                    </td>
                                    <td >
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="inputPrecio3" v-model="itemTabla.pvp3" :disabled="disabledPvp3[i]">
                                        </div>
                                    </td>
                                    <td >
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="inputPrecio3" v-model="itemTabla.pvp4" :disabled="disabledPvp4[i]">
                                        </div>
                                    </td>
                                    <td >
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="inputPrecio3" v-model="itemTabla.pvp5" :disabled="disabledPvp5[i]">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="row justify-content-md-center">
                                            <div class="col-6">
                                                <button class="btn btn-success mr-2" type="button" @click="editarPrecio(i, itemTabla)">
                                                    <i class="fas fa-edit" style="font-size: 15px"></i>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-danger mr-2" type="button" @click="borrarPrecio(itemTabla)">
                                                    <i class="fas fa-trash-alt" style="font-size: 15px"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <!--<td>
                                        <div class="row justify-content-md-center">
                                            <button class="btn btn-success" type="button" @click="editEmpleado(item.nip)">
                                                <i class="fas fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </td>-->  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import { getFamilia } from "../../../network/libs/almacen/almacen.js";
import { getSubfamilia } from "../../../network/libs/almacen/almacen.js";
import { getAllPoliticaPrecios } from "../../../network/libs/almacen/almacen.js";
import { getPrecioPorFamilia } from "../../../network/libs/almacen/almacen.js";
import { getPrecioPorSubfamilia } from "../../../network/libs/almacen/almacen.js";
import { savePrecio } from "../../../network/libs/almacen/almacen.js";
import { borrarPrecio } from "../../../network/libs/almacen/almacen.js";
import { getAllSubfamilias } from "../../../network/libs/almacen/almacen.js";
import { updateItemTabla } from "../../../network/libs/almacen/almacen.js";
import { getFiltroFamilia } from "../../../network/libs/almacen/almacen.js";
import { getFiltroSubfamilia } from "../../../network/libs/almacen/almacen.js";
import { getllantas } from "../../../network/libs/almacen/almacen.js";
import { exportarExcelPoliticaPrecios } from "../../../network/libs/almacen/almacen.js";

export default {
    data() {
    return {
        disabledPvp1: [],
        disabledPvp2: [],
        disabledPvp3: [],
        disabledPvp4: [],
        disabledPvp5: [],
        itemsFamilia: [],
        itemsSubfamilia: [],
        itemsFiltroFamilia: [],
        itemsFiltroSubfamilia: [],
        itemsPrecios: [],
        filtros: {
            filtroFamilia: 'TODOS',
            filtroSubfamilia: '',
        },
        value: {
            familia: '',
            subfamilia: '',
            pvp1: null,
            pvp2: null,
            pvp3: null,
            pvp4: null,
            pvp5: null,
        },
        selectFamilia: false,
        selectSubFamilia: true
    }
    },
    mounted() {
        this.getFamilia();
        this.getAllPoliticaPrecios();
        this.getAllSubfamilias();
        getFiltroFamilia().then((response) => {
            this.itemsFiltroFamilia = response.data;
        })
        .catch((err) => {
            alert(err.response.status)
        });
    },
    methods: {
        savePrecio() {
            if(this.selectFamilia == true)
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡ERROR!',
                    text: 'Existe un item en modificacion, imposible guardar registro',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            else if(this.value.familia == '' || this.value.subfamilia == '')
            {
                Swal.fire({
                    icon: 'warning',
                    title: '¡VALORES NULOS!',
                    text: 'Debes seleccionar la familia y la subfamilia',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            else
            {
                savePrecio(this.value).then((response) => {
                    if(response.data == false)
                    {
                        Swal.fire({
                            icon: 'warning',
                            title: '¡YA EXISTE!',
                            text: 'Esta subfamilia ya se encuentra registrada',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro Guardado!',
                            text: 'Se ha registrado esta subfamilia',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        this.cleansInputs()
                        this.value.familia = ''
                        this.filtros.filtroFamilia = 'TODOS'
                        this.filtros.filtroSubfamilia = ''
                        this.getAllPoliticaPrecios()
                        this.getAllSubfamilias()
                    }
                    })
                    .catch((err) => {
                        alert(err.response.status)
                });
            }
        },
        editarPrecio(item, itemTabla)
        {
            this.selectFamilia = true
            this.selectSubFamilia = true
            if(this.disabledPvp1[item] == true)
            {
                let statusPvp1 = null
                for (let i=0; i<this.itemsPrecios.length; i++) {
                    statusPvp1 = this.disabledPvp1[i]
                    if(statusPvp1 == false)
                    break
                }
                if(statusPvp1 == false)
                {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡ERROR!',
                        text: 'Existe un item en modificacion',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
                else
                {
                    this.disabledPvp1[item] = false
                    this.disabledPvp2[item] = false
                    this.disabledPvp3[item] = false
                    this.disabledPvp4[item] = false
                    this.disabledPvp5[item] = false
                    if(this.filtros.filtroFamilia == 'TODOS')
                    {
                        getAllPoliticaPrecios(this.filtros).then((response) => {
                            this.itemsPrecios = response.data
                        })
                        .catch((err) => {
                            alert(err.response.status)
                        })
                    }
                    else
                    {
                        getFiltroSubfamilia(this.filtros.filtroFamilia).then((response) => {
                            this.itemsFiltroSubfamilia = response.data;
                            })
                            .catch((err) => {
                                alert(err.response.status)
                        });
                    }
                }
            }
            else if(this.disabledPvp1[item] == false)
            {
                Swal.fire({
                    icon: 'success',
                    title: 'Precio Actualizado!',
                    text: 'Se han actualizado los precios de esta subfamilia',
                    showConfirmButton: false,
                    timer: 3000
                })
                updateItemTabla(itemTabla).then((response) => {
                        console.log(response.data)
                    })
                    .catch((err) => {
                        alert(err.response.status)
                    })
                this.disabledPvp1[item] = true
                this.disabledPvp2[item] = true
                this.disabledPvp3[item] = true
                this.disabledPvp4[item] = true
                this.disabledPvp5[item] = true
                if(this.filtros.filtroFamilia == 'TODOS')
                {
                    getAllPoliticaPrecios(this.filtros).then((response) => {
                        this.itemsPrecios = response.data
                        this.getAllPoliticaPrecios();
                        this.getAllSubfamilias()
                        this.selectFamilia = false
                    })
                    .catch((err) => {
                        alert(err.response.status)
                    })
                }
                else
                {
                    getFiltroSubfamilia(this.filtros.filtroFamilia).then((response) => {
                        this.itemsFiltroSubfamilia = response.data;
                        if(this.filtros.filtroSubfamilia == '')
                            this.getPrecioPorFamilia(this.filtros.filtroFamilia);
                        else
                            this.getPrecioPorSubfamilia()
                        this.selectFamilia = false
                        this.selectSubFamilia = false
                        })
                        .catch((err) => {
                            alert(err.response.status)
                    });
                }
            }
            
        },
        borrarPrecio(item)
        {
            if(this.selectFamilia == true)
            {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Existe un item en modificacion, imposible eliminar',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
            else
            {
                Swal.fire({
                    title: '¿Estás seguro de eliminar el precio de '+item.familia+' - '+item.subfamilia+'?',
                    text: "¡No podrás revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        borrarPrecio(item.id).then((response) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Precio Eliminado!',
                                text: 'Se ha eliminado este precio',
                                showConfirmButton: false,
                                timer: 3000
                                })
                            this.getAllPoliticaPrecios();
                            this.getAllSubfamilias()
                            })
                            .catch((err) => {
                                alert(err.response.status)
                        });
                    }
                })
            }
        },
        getFamilia() {
            getFamilia().then((response) => {
                this.itemsFamilia = response.data;
                
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getSubfamilia() {
            this.cleansInputs();
            getSubfamilia(this.value.familia).then((response) => {
                this.itemsSubfamilia = response.data;
            })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getFiltroFamilia() {
            this.filtros.filtroSubfamilia = '';
            if(this.filtros.filtroFamilia == 'TODOS')
            {
                this.getAllPoliticaPrecios()
                this.getAllSubfamilias()
                this.selectSubFamilia = true
            }
            else if(this.filtros.filtroFamilia == 'LLANTA')
            {
                this.selectSubFamilia = false
                getllantas().then((response) => {
                    this.itemsFiltroSubfamilia = response.data;
                    this.getPrecioPorFamilia(this.filtros.filtroFamilia)
                    var a = Object.values(this.itemsFiltroSubfamilia)
                    function SortArray(x, y){
                        if (x.subfamilia < y.subfamilia) {return -1;}
                        if (x.subfamilia > y.subfamilia) {return 1;}
                        return 0;
                    }
                    var s = a.sort(SortArray);
                    this.itemsFiltroSubfamilia = s
                })
                .catch((err) => {
                    alert(err.response.status)
                })
            }
            else
            {
                this.selectSubFamilia = false
                getFiltroSubfamilia(this.filtros.filtroFamilia).then((response) => {
                    this.itemsFiltroSubfamilia = response.data;
                    this.getPrecioPorFamilia(this.filtros.filtroFamilia)
                    })
                    .catch((err) => {
                        alert(err.response.status)
                });
            }
        },
        getAllSubfamilias() {
            getAllSubfamilias().then((response) => {
               this.itemsFiltroSubfamilia = response.data;
            })
            .catch((err) => {
                alert(err.response.status)
            })
        },
        getAllPoliticaPrecios() {
            getAllPoliticaPrecios(this.filtros).then((response) => {
                this.itemsPrecios = response.data
                this.itemsFiltroSubfamilia = []
                for (let i=0; i<this.itemsPrecios.length; i++) {
                    this.disabledPvp1[i] = true
                    this.disabledPvp2[i] = true
                    this.disabledPvp3[i] = true
                    this.disabledPvp4[i] = true
                    this.disabledPvp5[i] = true
                }
            })
            .catch((err) => {
                alert(err.response.status)
            })
        },
        getPrecioPorFamilia(idFamilia) {
            getPrecioPorFamilia(idFamilia).then((response) => {
                this.itemsPrecios = response.data
            })
            .catch((err) => {
                alert(err.response.status)
            })
        },
        getPrecioPorSubfamilia()
        {
            getPrecioPorSubfamilia(this.filtros).then((response) => {
                this.itemsPrecios = response.data
            })
            .catch((err) => {
                alert(err.response.status)
            })
        },
        exportarExcel()
        {
            exportarExcelPoliticaPrecios(this.filtros).then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'Politica de Precios.xlsx'); //or any other extension
            document.body.appendChild(link);
            link.click();
            })
            .catch((error) => {
                console.log(error);
            });
        },
        cleansInputs() {
            this.value.subfamilia = '',
            this.value.pvp1 = null,
            this.value.pvp2 = null,
            this.value.pvp3 = null,
            this.value.pvp4 = null,
            this.value.pvp5 = null
        }
    }
}
</script>