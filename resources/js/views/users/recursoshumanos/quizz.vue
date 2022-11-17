<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Registro de Preguntas</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-2 text-center">
                                    <label for="labelSucursal">Nivel</label>
                                    <select id="inputSucursal" class="form-control" v-model="value.nivel">
                                        <option v-for="(item, index) in itemsNivel" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 text-center">
                                    <label for="labelSucursal">Categoria</label>
                                    <select id="inputSucursal" class="form-control" v-model="value.clasificacion"> 
                                        <option v-for="(item, index) in itemsClasificacion" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 text-center">
                                    <label for="labelSucursal">Subcategoria</label>
                                    <select id="inputSucursal" class="form-control" v-model="value.subcategoria" @change="get"> 
                                        <option v-for="(item, index) in itemsSubcategoria" :value="item.id" :key="index">{{ item.descripcion }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9 text-center">
                                    <label for="inputNombre">Pregunta</label>
                                    <input type="text" placeholder="¿ ?" class="form-control text-uppercase" id="inputPregunta" v-model="value.pregunta">
                                </div>
                                <div class="form-group col-md-3 text-center">
                                    <label for="labelSucursal">¿Cuantas respuestas ingresas?</label>
                                    <select id="inputSucursal" class="form-control" v-model="selectRespuestas" @change="get">
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div v-if="this.corrects > 0" class="form-row">
                                <h4>Marca el check la(s) respuesta(s) correcta(s)</h4>
                            </div>
                            <div v-for="(correct, index) in corrects" :value="correct" :key="index" class="form-row">
                                <div v-if="value.subcategoria != 2" class="form-group col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="0" id="defaultCheck1" v-model="checkquizz[index]">
                                        <label for="inputNombre" id="labelRespuesta">Respuesta {{ correct }}</label>
                                        <input type="text" class="form-control" id="inputrespuesta" placeholder="ingresa la respuesta" v-model="txtquizz[index]">
                                    </div>
                                </div>
                                <div v-if="value.subcategoria == 2" class="form-group col-md-6">
                                        <input class="form-check-input" type="checkbox" value="0" id="defaultCheck1" v-model="checkquizz[index]">
                                        <label for="inputFotos">Foto {{ correct }}</label>
                                        <input type="file" class="form-control" accept="image/*" @change="previewImages($event, index)"/>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3 float-right my-2">
                            <button type="button" class="btn btn-success btn-lg btn-block" @click="validaQuizz">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Preguntas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label for="inputFamilia">Categoria</label>
                            <select id="inputCliente" class="form-control" v-model="filtro.categoria" @change="filtros">
                                <option value="0">TODOS</option>
                                <option v-for="(item, index) in itemsClasificacion" :value="item.id" :key="index">{{ item.descripcion }}</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <label for="inputFamilia">Nivel</label>
                            <select id="inputCliente" class="form-control" v-model="filtro.nivel" @change="filtros">
                                <option value="0">TODOS</option>
                                <option v-for="(item, index) in itemsNivel" :value="item.id" :key="index">{{ item.descripcion }}</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-3">
                            <label for="inputFamilia">Tipo</label>
                            <select id="inputCliente" class="form-control" v-model="filtro.subcategoria" @change="filtros">
                                <option value="0">TODOS</option>
                                <option v-for="(item, index) in itemsSubcategoria" :value="item.id" :key="index">{{ item.descripcion }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Nivel</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Pregunta</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, i) in itemsPreguntas" :key="i">
                                        <th>{{ item.clasificacion }}</th>
                                        <td>{{ item.nivel }}</td>
                                        <td>{{ item.tipo }}</td>
                                        <td>{{ item.pregunta }}</td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <button class="btn btn-primary mr-2" type="button" data-toggle="modal" data-target="#ModalPagos" @click="verRespuestas(item)">
                                                    <i class="fas fa-eye" style="font-size: 15px"></i>
                                                </button>
                                            
                                                <button class="btn btn-success mr-2" type="button" @click="editar(i, item)">
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
                        <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="ModalPagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Respuestas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-hover" data-dismiss="modal">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Respuesta</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item,i) in itemsRespuestas" :key="i">
                                                        <td>{{ i+1  }}</td>
                                                        <td v-if="item.tipo == null">{{ item.respuesta  }}</td>
                                                        <td v-if="item.tipo == 2">
                                                            <img id="frame" :src="`../../../../../images/quizz/Respuestas/${item.respuesta}.jpeg`">
                                                        </td>
                                                        <td v-if="item.estado == 1">Correcta</td>
                                                        <td v-if="item.estado == 0">Incorrecta</td>
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
                        <!--Fin Modal-->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import { getNivelquizz } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getClasificacionquizz } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getSubcategoriaquizz } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { saveQuizzPregunta } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { saveQuizzRespuestas } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { uploadPhotosQuizz } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { getPreguntasfiltrosQuizz } from "../../../network/libs/recursoshumanos/recursoshumanos.js";
import { verRespuestasQuizz } from "../../../network/libs/recursoshumanos/recursoshumanos.js";

export default {
    data() {
        return {
            itemsNivel: [],             //arreglo con los niveles del quizz
            itemsClasificacion: [],     //arreglo con las clasificaciones del quizz
            itemsSubcategoria: [],

            arrayIdsRespues: [],        //arreglo de id´s de las respuestas para poner nombre a las imagenes
            Arrayimage: [],             //arreglo  para guardar las imagenes a guardar
            selectRespuestas: 0,        //Valor del select de las respuestas correctas
            corrects: 0,                //Cantidad de respuestas correctas
            idPregunta: 0,              //Guarda el id de la pregunta creada
            txtquizz:[],                //arreglo para guardar las preguntas
            checkquizz:[],              //arreglo para los checks marcados
            value: {
                nivel: 0,
                clasificacion: 0,
                subcategoria: 0,
                pregunta: ''
            },
            data: {
                pregunta: 0,
                restxt: '',
                resImage: '',
                correcta: 0,
                subcategoria: 0
            }, 
            itemsPreguntas: [],
            itemsRespuestas: [],
            filtro: {
                categoria: 0,
                nivel: 0,
                subcategoria: 0
            }
            
        }
    },
    mounted() {
        this.getClasificacionquizz()
        this.getNivelquizz()
        this.getSubcategoriaquizz()
        this.filtros()
    },

    methods: {
        filtros()
        {   
            this.filtro.categoria = parseInt(this.filtro.categoria)
            this.filtro.nivel = parseInt(this.filtro.nivel)
            this.filtro.subcategoria = parseInt(this.filtro.subcategoria)
            getPreguntasfiltrosQuizz(this.filtro).then((response) => {
                this.itemsPreguntas = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        verRespuestas(item)
        {
            verRespuestasQuizz(item.id).then((response) => {
                this.itemsRespuestas = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        editar(i, item)
        {
            console.log("Editado")
        }, 
        borrar(item)
        {
            console.log("Borrado")
        },
       async uploadFotos()
        {
            let statusUpload = true
            for (let i = 0; i < this.Arrayimage.length; i++) 
            {
                let foto = this.Arrayimage[i];
                let data = new FormData();
                data.append("foto", foto);
                data.append("codigo", this.arrayIdsRespues[i]);
                data.append("name", 'Respuestas');

                await uploadPhotosQuizz(data).then((response) => {
                    statusUpload = response.data
                })
                .catch((err) => {
                    switch (err.response.status) {
                    case 422:
                        Swal.fire({
                        icon: "error",
                        title: "Archivo Erroneo",
                        showConfirmButton: false,
                        timer: 2500,
                        });
                    case 200:
                        Swal.fire({
                        icon: "error",
                        title: "ERROR",
                        showConfirmButton: false,
                        timer: 2500,
                        });
                    }
                })
                if(statusUpload == false)
                    break
            }
            if(statusUpload == true)
            {
                Swal.fire({
                    icon: "success",
                    title: "Imagenes Registradas!",
                    text: "Las respuestas han sido almacenadas exitosamente",
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
        },
        previewImages(event, i)
        {
            this.Arrayimage[i] = event.target.files[0]
        },
        getNivelquizz()
        {
            getNivelquizz().then((response) => {
                this.itemsNivel = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getClasificacionquizz()
        {
            getClasificacionquizz().then((response) => {
                this.itemsClasificacion = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        getSubcategoriaquizz()
        {
            getSubcategoriaquizz().then((response) => {
                this.itemsSubcategoria = response.data;
                })
                .catch((err) => {
                    alert(err.response.status)
            });
        },
        get()
        {
            this.corrects = parseInt(this.selectRespuestas)
            this.txtquizz = []
            this.Arrayimage = []
            this.checkquizz =[]

            if(this.corrects>this.Arrayimage.length)
            {
                for (let j=0; j<this.corrects; j++) {
                    this.Arrayimage[j] = j;
                    this.checkquizz[j] = false
                    this.txtquizz[j] = ""
                }
            }
        },
        validaQuizz()
        {
            let statusCheck = false
            for (let n=0; n<this.corrects; n++) 
            {
                statusCheck = this.checkquizz[n]
                if(this.checkquizz[n] == true)
                {
                    statusCheck = this.checkquizz[n]
                    break
                }                
            }
            if(this.value.nivel == 0 || this.value.clasificacion == 0 || this.value.subcategoria == 0 || this.value.pregunta == '' || this.selectRespuestas == 0)
            {
                Swal.fire({
                  icon: "error",
                  title: "Campos Incompletos",
                  text: "Completa todos los campos",
                  showConfirmButton: false,
                  timer: 2500,
                });
            }
            else if(statusCheck == false)
            {
                Swal.fire({
                  icon: "error",
                  title: "Check Desmarcado",
                  text: "Debes marcar al menos un check para la respuesta correcta",
                  showConfirmButton: false,
                  timer: 2500,
                });
            }
            else
            {
                if(this.value.subcategoria == 2)
                {
                    let status = false
                    for (let m=0; m<this.corrects; m++) 
                    {
                        status = isNaN(this.Arrayimage[m])
                        if(status == false)
                        {
                            Swal.fire({
                            icon: "error",
                            title: "Faltan Imagenes",
                            text: "Carga todas las imagenes que te piden",
                            showConfirmButton: false,
                            timer: 2500,
                            });
                            break;
                        }
                    }
                    if(status == true)
                    {
                        console.log("guarda quizz respuestas imagenes")
                        this.saveQuizz()
                    }
                }
                else
                {
                    let statusRespuestas = false
                    for (let p=0; p<this.corrects; p++) 
                    {
                        statusRespuestas = this.txtquizz[p] === ""
                        if(statusRespuestas == true)
                        {
                            Swal.fire({
                                icon: "error",
                                title: "Faltan Respuestas",
                                text: "Completa todas las respuestas",
                                showConfirmButton: false,
                                timer: 2500,
                            });
                            break
                        }            
                    }
                    if(statusRespuestas == false)
                    {
                        console.log("guarda quizz respuestas texto")
                        this.saveQuizz()
                    }
                }
            }
        },
        async saveQuizz()
        {
            await saveQuizzPregunta(this.value).then((response) => {
                this.idPregunta = response.data
            })
            .catch((err) => {
                alert(err.response.status)
            });
            
            this.data.pregunta = this.idPregunta
            this.data.subcategoria = this.value.subcategoria

            for (let i=0; i<this.corrects; i++) 
            {
                this.data.restxt = this.txtquizz[i]
                this.data.correcta = this.checkquizz[i]
    
                await saveQuizzRespuestas(this.data).then((response) => {
                    this.arrayIdsRespues.push(response.data);
                    Swal.fire({
                        icon: "success",
                        title: "Respuesta "+(i+1)+" Registrada!",
                        text: "La respuesta ha sido almacenada exitosamente",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                })
                .catch((err) => {
                    alert(err.response.status)
                });
            }
            
            if(this.value.subcategoria == 2)
            {
                await this.uploadFotos()
            }
            await this.cleansInputs()
            await this.filtros()  
        },
        cleansInputs()
        {
            this.value.nivel = 0,
            this.value.clasificacion = 0,
            this.value.pregunta = ''
            this.value.subcategoria = 0
            
            this.data.pregunta = 0,
            this.data.restxt = '',
            this.data.resImage = '',
            this.data.correcta = 0
            this.data.subcategoria = 0,
            
            this.arrayIdsRespues = [],        
            this.Arrayimage = [],             //arreglo  para guardar las imagenes a guardar
            this.selectRespuestas = 0,        //Valor del select de las respuestas correctas
            this.corrects = 0,                //Cantidad de respuestas correctas
            this.idPregunta = 0,              //Guarda el id de la pregunta creada
            this.txtquizz =[],                //arreglo para guardar las preguntas
            this.checkquizz =[]               //arreglo para los checks marcados
        }
    }
}
</script>

<style>
#frame{
width: 180px;
height: 150px;
}
</style>