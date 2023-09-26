<?php
$pagina = "cliente";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$consulta = "SELECT * FROM cliente ORDER BY clave";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);



$message = "";



?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header bg-gradient-green text-light">
        <h1 class="card-title mx-auto">CLIENTES</h1>
      </div>

      <div class="card-body">

        <div class="row">
          <div class="col-lg-12">
            <button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>
          </div>
        </div>
        <br>
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered table-condensed text-nowrap w-auto mx-auto" style="width:100%">
                  <thead class="text-center bg-gradient-green">
                    <tr>
                      <th>ID</th>
                      <th>RFC</th>
                      <th>NOMBRE / RAZON SOCIAL</th>
                      <th>TEL</th>
                      <th>CORREO</th>
                      <th>ACCIONES</th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data as $dat) {
                    ?>
                      <tr>
                        <td><?php echo $dat['clave'] ?></td>
                        <td><?php echo $dat['rfc'] ?></td>
                        <td><?php echo $dat['nombre'] ?></td>
                        <td><?php echo $dat['tel_cel'] ?></td>
                        <td><?php echo $dat['email'] ?></td>
                        <td></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.card-body -->

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>

  <!-- PROVEEDOR -->
  <section>
    <div class="modal" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-green">
            <h5 class="modal-title" id="exampleModalLabel">NUEVO CLIENTE</h5>

          </div>
          <div class="card card-widget" style="margin: 10px;">
            <form id="formDatos" action="" method="POST">
              <div class="modal-body row">

              <div class="col-sm-4">
                  <div class="form-group input-group-sm">
                    <label for="clave" class="col-form-label">Clave:</label>
                    <input type="text" class="form-control" name="clave" id="clave" autocomplete="off" placeholder="Clave" disabled>
                  </div>
                </div>
                

                <div class="col-sm-4">
                  <div class="form-group input-group-sm">
                    <label for="rfc" class="col-form-label">RFC:</label>
                    <input type="text" class="form-control" name="rfc" id="rfc" autocomplete="off" placeholder="RFC">
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group input-group-sm">
                    <label for="folio" class="col-form-label">Folio Identificación:</label>
                    <input type="text" class="form-control" name="folio" id="folio" autocomplete="off" placeholder="Folio Identificación">
                  </div>
                </div>


                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="razon" class="col-form-label">Nombre o Razón Social:</label>
                    <input type="text" class="form-control" name="razon" id="razon" autocomplete="off" placeholder="Nombre o Razón Social">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="calle" class="col-form-label">Calle y Número:</label>
                    <input type="text" class="form-control" name="calle" id="calle" autocomplete="off" placeholder="Calle y Número">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="colonia" class="col-form-label">Colonia:</label>
                    <input type="text" class="form-control" name="colonia" id="colonia" autocomplete="off" placeholder="Colonia">
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group input-group-sm">
                    <label for="cp" class="col-form-label">CP:</label>
                    <input type="text" class="form-control" name="cp" id="cp" autocomplete="off" placeholder="CP">
                  </div>
                </div>

                <div class="col-sm-5">
                  <div class="form-group input-group-sm">
                    <label for="ciudad" class="col-form-label">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" id="ciudad" autocomplete="off" placeholder="Ciudad">
                  </div>
                </div>
               
                <div class="col-sm-5">
                  <div class="form-group input-group-sm">
                    <label for="estado" class="col-form-label">Estado:</label>
                    <input type="text" class="form-control" name="estado" id="estado" autocomplete="off" placeholder="Estado">
                  </div>
                </div>

               

                <div class="col-sm-4">
                  <div class="form-group input-group-sm">
                    <label for="telm" class="col-form-label">Tel. Movil:</label>
                    <input type="text" class="form-control" name="telm" id="telm" autocomplete="off" placeholder="Tel. Movil">
                  </div>
                </div>
                

                <div class="col-sm-4">
                  <div class="form-group input-group-sm">
                    <label for="telc" class="col-form-label">Tel. Casa:</label>
                    <input type="text" class="form-control" name="telc" id="telc" autocomplete="off" placeholder="Tel. Casa">
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group input-group-sm">
                    <label for="telt" class="col-form-label">Tel. Trabajo:</label>
                    <input type="text" class="form-control" name="telt" id="telt" autocomplete="off" placeholder="Tel. Trabajo">
                  </div>
                </div>



                
                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="correo" class="col-form-label">Correo Electrónico:</label>
                    <input type="text" class="form-control" name="correo" id="correo" autocomplete="off" placeholder="Corre Electrónico">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="nacionalidad" class="col-form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" autocomplete="off" placeholder="Nacionalidad">
                  </div>
                </div>
              
                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="edoc" class="col-form-label">Estado Civil:</label>
                    <input type="text" class="form-control" name="edoc" id="edoc" autocomplete="off" placeholder="Estado Civil">
                  </div>
                </div>
                
                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="banco" class="col-form-label">Banco:</label>
                    <input type="text" class="form-control" name="banco" id="banco" autocomplete="off" placeholder="Banco">
                  </div>
                </div>

                
                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="cuenta" class="col-form-label">Cuenta:</label>
                    <input type="text" class="form-control" name="cuenta" id="cuenta" autocomplete="off" placeholder="Cuenta">
                  </div>
                </div>

              </div>
          </div>


          <?php
          if ($message != "") {
          ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <span class="badge "><?php echo ($message); ?></span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>

            </div>

          <?php
          }
          ?>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
            <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>




  <!-- /.content -->
</div>






<?php include_once 'templates/footer.php'; ?>
<script src="fjs/cntacliente.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.21/sorting/formatted-numbers.js"></script>