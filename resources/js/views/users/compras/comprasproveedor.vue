<template>
    <div class="row mx-3">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">Compras a Proveedor</div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="form-row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                        <label for="inputNombre">Proveedor</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-uppercase" id="inputNombre">
                                            <div class="input-group-append">
                                                <button id="show_confirmpassword" class="btn btn-light" type="button">
                                                <span class="fas fa-search"></span> </button>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputDepartamento">Almacén</label>
                                        <select id="inputDepartamento" class="form-control">
                                            <option value="Prueba"></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputFechaFolios">Fecha</label>
                                        <input type="date" class="form-control" id="inputFechaFolios" >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputNombre">Folio Interno</label>
                                        <input type="text" class="form-control text-uppercase" id="inputNombre">
                                    </div> 
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputNombre">Folio Proveedor</label>
                                        <input type="text" class="form-control text-uppercase" id="inputNombre">
                                    </div> 
                                    <div class="col-md-2 text-center">
                                        <label for="inputFechaFolios">Fecha Proveedor</label>
                                        <input type="date" class="form-control" id="inputFechaFolios" >
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputDepartamento">Tipo de Compra</label>
                                        <select id="inputDepartamento" class="form-control">
                                            <option value="Prueba"></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputDepartamento">Tipo de Proveedor</label>
                                        <select id="inputDepartamento" class="form-control">
                                            <option value="Prueba"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 text-center">
                                        <label for="inputFechaFolios">Fecha Vencimiento</label>
                                        <input type="date" class="form-control" id="inputFechaFolios" >
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputRFC">Dias</label>
                                        <input type="number" class="form-control text-uppercase" id="inputRFC">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="form-row my-3 justify-content-center">
                                    <button type="button" class="btn btn-info btn-block ml-4" data-toggle="modal" data-target="#exampleModalCenter">Get XML</button>
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Buscar Proveedor</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="col-md-7">
                                                            <label for="inputNombre">Proveedor</label>
                                                            <input type="text" class="form-control text-uppercase" id="inputNombre">  
                                                        </div>
                                                        <div class="col-md-3 text-center">
                                                            <label for="inputFechaFolios">Fecha</label>
                                                            <input type="date" class="form-control" id="inputFechaFolios" >
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <table class="table table-striped table-hover" data-dismiss="modal">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Proveedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td scope="row">1</td>
                                                                <td>PRUEBA</td>
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
                                <div class="form-row my-3 justify-content-center">
                                    <button type="button" class="btn btn-primary btn-block ml-4">
                                        <i class="fas fa-print"></i>Imp Etiquetas
                                    </button>
                                </div>
                                <div class="form-row my-3 justify-content-center">
                                    <button type="button" class="btn btn-primary btn-block ml-4">Imprimir
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-row">
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputNombre">Código</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control text-uppercase" id="inputNombre">
                                            <div class="input-group-append">
                                                <button id="show_confirmpassword" class="btn btn-light" type="button">
                                                <span class="fas fa-search"></span> </button>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="form-group col-md-1">
                                        <label for="inputRFC">Cantidad</label>
                                        <input type="number" class="form-control text-uppercase" id="inputRFC">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputDepartamento">Impuesto</label>
                                        <select id="inputDepartamento" class="form-control">
                                            <option value="Prueba"></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputRFC">Costo</label>
                                        <input type="number" class="form-control text-uppercase" id="inputRFC">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="form-row">
                                    <div class="col align-self-center"> 
                                        <div class="form-row my-4 justify-content-center">
                                            <button type="button" class="btn btn-secondary">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row my-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Cto. Unitario</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Impuestos</th>
                                    <th scope="col">Cto. Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" >1</th>
                                        <td>XXNXX</td>
                                        <td>PRUEBA PRUEBA</td>
                                        <td>500.00</td>
                                        <td>10</td>
                                        <td>80.00</td>
                                        <td>5,800.00</td>
                                        <td>
                                            <button class="btn btn-danger mr-2" type="button">
                                                <i class="fas fa-times" style="font-size: 15px"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="row">
                                <label>Observaciones</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="row">
                                <div class="col-xs-3 col-sm-6 col-md-6 col-lg-9 text-right">
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
                                            Impuestos
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
                                        
                                            $5,000.00
                                        
                                    </div>
                                    <div class="row">
                                        $50.00
                                    </div>
                                   
                                    <div class="row">
                                        
                                            $800.00
                                       
                                    </div>
                                    <div class="row">
                                        
                                            $5,800.00
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-row my-3 justify-content-center">
                                        <button type="button" class="btn btn-danger">Cancelar</button>
                                    </div>
                                    <div class="form-row my-3 justify-content-center">
                                        <button type="button" class="btn btn-warning">Limpiar</button>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 align-self-center">
                                    <div class="row justify-content-center">
                                        <button class="btn btn-success mr-2" type="button">
                                            <i class="fas fa-save" style="font-size: 30px"></i>
                                            <span class="row justify-content-md-center">Guardar</span>
                                        </button>
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

export default {
    data() {
        return {
            valor: 5000
        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>