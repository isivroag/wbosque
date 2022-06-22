<?php
$pagina = "proyecto";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$consulta = "SELECT * FROM w_proyecto WHERE estado_proy=1 ORDER BY id_proy";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$message = "";

$consultacon = "SELECT * FROM w_empresa WHERE estado_emp=1 ORDER BY id_emp";
$resultadocon = $conexion->prepare($consultacon);
$resultadocon->execute();
$datacon = $resultadocon->fetchAll(PDO::FETCH_ASSOC);



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
        <h1 class="card-title mx-auto">PROYECTOS</h1>
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
                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered table-condensed w-auto mx-auto" style="width:100%">
                  <thead class="text-center bg-gradient-green">
                    <tr>
                      <th>ID</th>
                      <th>CLAVE</th>
                      <th>NOMBRE CORTO</th>
                      <th>ID EMP</th>
                      <th>EMPRESA RESPONSABLE</th>
                      <th>ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data as $dat) {
                    ?>
                      <tr>
                        <td><?php echo $dat['id_proy'] ?></td>
                        <td><?php echo $dat['clave_proy'] ?></td>
                        <td><?php echo $dat['nom_proy'] ?></td>
                        <td><?php echo $dat['id_emp'] ?></td>
                        <td><?php echo $dat['razon_emp'] ?></td>
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



  <section>
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-green">
            <h5 class="modal-title" id="exampleModalLabel">NUEVO PROYECTO</h5>

          </div>
          <div class="card card-widget" style="margin: 10px;">
            <form id="formDatos" action="" method="POST">
              <div class="modal-body row">

                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="clave" class="col-form-label">CLAVE:</label>
                    <input type="text" class="form-control" name="clave" id="clave" autocomplete="off" placeholder="CLAVE">
                    <input type="hidden" class="form-control" name="id_proyecto" id="id_proyecto" autocomplete="off">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="nombre" class="col-form-label">NOMBRE DEL PROYECTO:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" placeholder="NOMBRE DEL PROYECTO">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="input-group input-group-sm">
                    <label for="empresa" class="col-form-label">EMPRESA RESPONSABLE:</label>
                    <div class="input-group input-group-sm">
                      <input type="hidden" class="form-control" name="id_emp" id="id_emp">
                      <input type="text" class="form-control" name="empresa" id="empresa" disabled placeholder="SELECCIONAR EMPRESA">
                      <span class="input-group-append">
                        <button id="bempresa" type="button" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                      </span>
                    </div>

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
            <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <section>
    <div class="container">

      <!-- Default box -->
      <div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-md" role="document">
          <div class="modal-content w-auto">
            <div class="modal-header bg-gradient-green">
              <h5 class="modal-title" id="exampleModalLabel">BUSCAR EMPRESA</h5>

            </div>
            <br>
            <div class="table-hover table-responsive w-auto" style="padding:15px">
              <table name="tablaEmpresa" id="tablaEmpresa" class="table table-sm table-striped table-bordered table-condensed " style="width:100%">
                <thead class="text-center bg-gradient-green">
                  <tr>
                    <th>ID</th>
                    <th>RFC</th>
                    <th>RAZON SOCIAL</th>
                    <th>ACCIONES</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($datacon as $datc) {
                  ?>
                    <tr>
                      <td><?php echo $datc['id_emp'] ?></td>
                      <td><?php echo $datc['rfc_emp'] ?></td>
                      <td><?php echo $datc['razon_emp'] ?></td>
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

  </section>



  <!-- /.content -->
</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/cntaproyecto.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>