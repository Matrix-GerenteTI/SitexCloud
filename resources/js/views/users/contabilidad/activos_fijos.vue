<template>
  <div class="row mx-2">
    <div class="col-md-12">
      <div class="card my-4">
        <div class="card-header">
          <h5 class="card-title font-weight-bold">Activos Fijos</h5>
        </div>
        <div class="card-body">
          <div style="max-height: 200px !important">
            <div id="overlay">    
            </div>          
        </div>
          <form>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputSucursal">Sucursal</label>
                <select
                  id="inputSucursal"
                  class="form-control"
                  v-model="value.sucursal"
                >
                  <option
                    v-for="(item, index) in itemsSucursal"
                    :value="item.id"
                    :key="index"
                  >
                    {{ item.descripcion }}
                  </option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputSucursal">Categoria</label>
                <select
                  id="inputSucursal"
                  class="form-control"
                  v-model="value.categoria"
                  @change="getSubcategoria"
                >
                  <option
                    v-for="(item, index) in itemsCategoria"
                    :value="item.id"
                    :key="index"
                  >
                    {{ item.nombreCategoria }}
                  </option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputSucursal">Subcategoria</label>
                <select
                  id="inputSucursal"
                  class="form-control"
                  v-model="value.subcategoria"
                >
                  <option
                    v-for="(item, index) in itemsSubcategoria"
                    :value="item.id"
                    :key="index"
                  >
                    {{ item.nombreSubcategoria }}
                  </option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputFechaNacimiento">Fecha de adquisición</label>
                <input
                  type="date"
                  class="form-control"
                  id="inputFechaNacimiento"
                  v-model="value.fechaAdquisicion"
                />
              </div>
              <div class="col-md-2">
                <label for="inputRFC">Costo</label>
                <input
                  type="number"
                  class="form-control text-uppercase"
                  placeholder="0"
                  id="inputRFC"
                  v-model="value.valorAdquisicion"
                />
              </div>
              <div class="form-group col-md-2">
                <label for="inputRFC">Cantidad</label>
                <input
                  type="number"
                  class="form-control text-uppercase"
                  placeholder="0"
                  id="inputRFC"
                  v-model="value.cantidad"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputNombre">Marca</label>
                <input
                  type="text"
                  class="form-control text-uppercase"
                  id="inputNombre"
                  v-model="value.marca"
                />
              </div>
              <div class="form-group col-md-4">
                <label for="inputNombre">Modelo</label>
                <input
                  type="text"
                  class="form-control text-uppercase"
                  id="inputNombre"
                  v-model="value.modelo"
                />
              </div>
              <div class="form-group col-md-4">
                <label for="inputNombre">Serie (IMEI)</label>
                <input
                  type="text"
                  class="form-control text-uppercase"
                  id="inputNombre"
                  v-model="value.serie"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputNombre">Descripción</label>
                <input
                  type="text"
                  class="form-control text-uppercase"
                  id="inputNombre"
                  v-model="value.descripcion"
                />
              </div>
              <div class="form-group col-md-6">
                <label for="inputFotos">Fotos</label>
                <input
                  type="file"
                  class="form-control"
                  accept="image/*"
                  id="MultipleFotoActivos"
                  multiple
                  @change="previewImages($event)"
                />
              </div>
            </div>
          </form>
            <div class="d-flex justify-content-center">
            <div class="spinner-border text-success" role="status" id="spinner">
                <span class="sr-only">Loading...</span>
            </div>
          </div>
          <div class="float-right">
            <button type="button" class="btn btn-success" @click="save">
              Registrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card my-4">
        <div class="card-header">
          <h5 class="card-title font-weight-bold">Activos Fijos</h5>
        </div>
        <div class="card-body">                 
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
              <label for="inputSucursal">Sucursal</label>
              <select id="inputSucursal" class="form-control" v-model="filtroSucursal" @change="getFiltroActivos">
                  <option value="0">TODOS</option>
                  <option v-for="(item, index) in itemsSucursal" :value="item.id" :key="index">{{ item.descripcion }}</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
              <label for="inputSucursal">Equipo</label>
              <select id="inputSucursal" class="form-control" v-model="filtroEquipo" @change="getFiltroActivos">
                  <option value="0">TODOS</option>
                  <option v-for="(item, index) in itemsAllEquipos" :value="item.id" :key="index">{{ item.nombreSubcategoria }}</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 offset-md-3 d-flex align-items-center justify-content-center">
              <div class="row">
                  <button type="button" class="btn btn-primary" @click="exportarExcel">Exportar Excel</button>
              </div>
            </div>
          </div>
          <div class="row my-4">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Serie</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, i) in itemsGetActivos" :key="i">
                    <th scope="row" >{{ item.descripcion }}</th>
                    <td>{{ item.nombreCategoria }}</td>
                    <td>{{ item.nombreSubcategoria }}</td>
                    <td>{{ item.cantidad }}</td>
                    <td>${{ item.valorAdquisicion }}</td>
                    <td>{{ item.marca }}</td>
                    <td>{{ item.modelo }}</td>
                    <td>{{ item.noSerie }}</td>
                    <td>
                      <button class="btn btn-danger mr-2" type="button" @click="bajaActivo">
                        <i class="fas fa-trash-alt" style="font-size: 15px"></i>
                      </button>
                      <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold">Baja de Activo Fijo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                        <label for="inputFechaNacimiento">Fecha*</label>
                                        <input type="date" class="form-control" id="inputfecha" v-model="baja.fechaBaja">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <label>Observaciones</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="baja.motivoBaja"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" @click="borrarRegistro(item.id)">Eliminar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                    <!--Fin Modal-->
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>

  
</template>

<script>
import Swal from "sweetalert2";
import { getSucursal } from "../../../network/libs/gets/gets.js";
import { getCategoria } from "../../../network/libs/gets/gets.js";
import { getSubcategoria } from "../../../network/libs/gets/gets.js";
import { uploadPhotosActivos } from "../../../network/libs/contabilidad/contabilidad.js";
import { saveActivoFijo } from "../../../network/libs/contabilidad/contabilidad.js";
//import { getActivosFijos } from "../../../network/libs/contabilidad/contabilidad.js";
import { borrarActivo } from "../../../network/libs/contabilidad/contabilidad.js";
import { exportarExcelActivos } from "../../../network/libs/contabilidad/contabilidad.js";
import { getAllSubcategorias } from "../../../network/libs/gets/gets.js";
import { getFiltroActivos } from "../../../network/libs/contabilidad/contabilidad.js";

export default {
  data() {
    return {
      itemsGetActivos: [],
      itemsSucursal: [],
      itemsCategoria: [],
      itemsSubcategoria: [],
      itemsAllEquipos: [],
      Arrayimage: [],
      value: {
        sucursal: 0,
        categoria: 0,
        subcategoria: 0,
        cantidad: null,
        fotos: "",
        descripcion: "",
        fechaAdquisicion: null,
        valorAdquisicion: null,
        marca: "",
        modelo: "",
        serie: "",
        path: "public/images/activosFijos",
      },
      filtroSucursal: 0,
      filtroEquipo: 0,
      baja: {
        fechaBaja: null,
        motivoBaja: ""
      }
    };
  },
  mounted() {
    this.filtroSucursal = parseInt(this.filtroSucursal)
    this.filtroEquipo = parseInt(this.filtroEquipo)
    document.getElementById('spinner').style.display = 'none';
    this.getFiltroActivos()
    this.getSelects()
  },
  methods: {
    exportarExcel()
    {
        exportarExcelActivos(this.itemsGetActivos).then((response) => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'Activos Fijos.xlsx'); //or any other extension
          document.body.appendChild(link);
          link.click();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async getSelects()
    {
      await getSucursal().then((response) => {
        this.itemsSucursal = response.data;
      })
      .catch((err) => {
        alert(err.response.status);
      });
      await getCategoria().then((response) => {
        this.itemsCategoria = response.data;
      })
      .catch((err) => {
        alert(err.response.status);
      });
      await getAllSubcategorias().then((response) => {
        this.itemsAllEquipos = response.data;
      })
      .catch((err) => {
        alert(err.response.status);
      });
    },
    getFiltroActivos()
    {
      let data = {
        idSucursal: this.filtroSucursal,
        idEquipo: this.filtroEquipo
      }
      getFiltroActivos(data).then((response) => {
        this.itemsGetActivos = response.data
        this.baja.fechaBaja = null,
        this.baja.motivoBaja = ""
      })
      .catch((err) => {
        alert(err.response.status);
      });
    },
    getSubcategoria() {
      getSubcategoria(this.value.categoria)
        .then((response) => {
          this.itemsSubcategoria = response.data;
        })
        .catch((err) => {
          alert(err.response.status);
        });
    },
    previewImages(event)
        {
            let size = event.target.files.length;
            for(let i=0; i<size; i++)
            {
                this.Arrayimage[i] = event.target.files[i]
            }
        },
    async uploadImage(nameFolder) {
      document.getElementById('spinner').style.display = 'block';
      document.getElementById("overlay").style.display = "block";
      //let input = document.getElementById("MultipleFotoActivos");
      
      let statusUpload = true
      for (let i = 0; i < this.Arrayimage.length; i++) 
      {
        let data = new FormData();
        data.append("foto", this.Arrayimage[i]);
        data.append("codigo", "Activo" + (i+1));
        data.append("name", nameFolder);

        await uploadPhotosActivos(data).then((response) => {
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
          });
          if(statusUpload == false)
            break
      }
      if(statusUpload == true)
            {
                Swal.fire({
                    icon: "success",
                    title: "Imagenes Registradas!",
                    text: "Las imagenes han sido almacenadas exitosamente",
                    showConfirmButton: false,
                    timer: 3000,
                });
            }
      document.getElementById('spinner').style.display = 'none';
      document.getElementById("overlay").style.display = "none";
      //document.getElementById("MultipleFotoActivos").reset()
    },
    /*getActivosFijos()
    {
      getActivosFijos().then((response) => {
          this.itemsGetActivos = response.data;
          console.log(this.itemsGetActivos)
        })
        .catch((err) => {
          alert(err.response.status);
        });
    },*/
    save() {
      if(this.value.sucursal == 0 || this.value.categoria == 0 || this.value.subcategoria == 0)
      {
        Swal.fire({
          icon: "error",
          title: "ERROR",
          text: 'Selecciona los selects',
          showConfirmButton: false,
          timer: 2500,
        });
      }
      else
      {
        /*let input = document.getElementById("MultipleFotoActivos");
        if(input.files.length == 0)
        {
          Swal.fire({
          icon: "error",
          title: "ERROR",
          text: 'No has seleccionado una foto',
          showConfirmButton: false,
          timer: 2500,
        });
        }
        else{*/
          saveActivoFijo(this.value).then((response) => {
          this.uploadImage(response.data);
          Swal.fire({
            icon: "success",
            title: "¡Activo Guardado!",
            text: "Registro Exitosamente",
            showConfirmButton: false,
            timer: 3000,
          });
          this.getFiltroActivos()
          this.clear()
        })
        .catch((err) => {
          alert(err.response.status);
        });
        //}
      }
    },
    bajaActivo()
    {
      $('#exampleModalCenter').modal('toggle')
    },
    borrarRegistro(id)
    {
      Swal.fire({
        title: '¿Estás seguro de dar de baja el activo fijo?',
        text: "¡No podrás revertir esta accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
          if(this.baja.fechaBaja == null || this.baja.motivoBaja == "")
          {
            Swal.fire({
              icon: 'error',
              title: '¡Faltan Campos!',
              text: 'Ingresa todos los campos',
              showConfirmButton: false,
              timer: 1500
            })
          }
          else
          {
            borrarActivo(id, this.baja).then((response) => {
              Swal.fire({
                icon: 'success',
                title: '¡Registro Eliminado!',
                text: 'Se ha dado de baja este activo',
                showConfirmButton: false,
                timer: 1500
                })
              this.getFiltroActivos()
              $('#exampleModalCenter').modal('hide')
              })
              .catch((err) => {
                alert(err.response.status);
            });
          }
        }
    })
    },
    clear()
    {
      this.value.sucursal = 0,
      this.value.categoria = 0,
      this.value.subcategoria = 0,
      this.value.cantidad = null,
      this.value.fotos = "",
      this.value.descripcion = "",
      this.value.fechaAdquisicion = null,
      this.value.valorAdquisicion = null,
      this.value.marca = "",
      this.value.modelo = "",
      this.value.serie = "",
      document.getElementById("MultipleFotoActivos").value = "";
    }
  },
};
</script>

<style>
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
</style>
