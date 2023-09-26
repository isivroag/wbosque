<?php
$pagina = "cntaapartados";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$consulta = "SELECT * FROM vapartado WHERE estado=0  ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$message = "";



?>
 <style>
        /* Define un estilo CSS para la columna 'descripcion' */
        .multi-line-column {
            white-space: pre-line;
        }
    </style>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header bg-gradient-green text-light">
        <h1 class="card-title mx-auto">APARTADOS</h1>
      </div>

      <div class="card-body">

     
       
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered table-condensed text-nowrap w-auto mx-auto" style="font-size:15px; width:100%">
                  <thead class="text-center bg-gradient-green">
                    <tr>
                      <th>FOLIO</th>
                      <th>CLIENTE</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>INMUEBLE</th>
                      <th class="text-center">FECHA</th>
                      <th class="text-center">FECHA LIMITE</th>
                      <th>APARTADO POR</th>
                      <th>IMPORTE APARTADO</th>
                      <th>ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data as $dat) {
                    ?>
                      <tr>
                        <td><?php echo $dat['folio_apartado'] ?></td>
                        <td class="multi-line-column"><?php echo $dat['cliente'] ?></td>
                        <td><?php echo $dat['clave_proyecto'] ?></td>
                        <td><?php echo $dat['clave_manzana'] ?></td>
                        <td><?php echo $dat['clave_lote'] ?></td>
                        <td><?php echo $dat['concepto'] ?></td>
                        <td class="text-center"><?php echo $dat['fecha'] ?></td>
                        <td class="text-center"><?php echo $dat['limite'] ?></td>
                        <td><?php echo $dat['nombre'] ?></td>
                        <td class="text-right"><?php echo number_format($dat['suma'],2) ?></td>
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


  <!-- /.content -->
</div>


<?php include_once 'templates/footer.php'; ?>

<script src="fjs/cntaapartados.js?v=<?php echo(rand()); ?>"></script>
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
<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/formatted-numbers.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/locale/es.js"></script>