<?php
$pagina = "cntacobranza";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();



$message = "";

if (isset($_GET['id_clie'])) {
    $id_clie = $_GET['id_clie'];

    $consulta = "SELECT clave,nombre FROM cliente where clave='$id_clie' ORDER BY clave";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row){
        $cliente=$row['nombre'];

    }

    $consulta = "SELECT clave,nombre FROM cliente ORDER BY clave";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


    $consulta = "SELECT venta.folio_venta,venta.folio_presupuesto,venta.clave_proyecto,presupuesto.concepto,venta.fecha,venta.total,venta.saldo
    FROM venta JOIN presupuesto 
    WHERE venta.folio_presupuesto = presupuesto.folio AND venta.clave_cliente='$id_clie'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $datalotes = $resultado->fetchAll(PDO::FETCH_ASSOC);

}else{
    $id_clie="";
    $cliente="";
    $consulta = "SELECT clave,nombre FROM cliente ORDER BY clave";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
}

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
                <h1 class="card-title mx-auto">CONSULTA DE COBRANZA</h1>
            </div>

            <div class="card-body">



                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header bg-gradient-green">
                                    SELECCIONAR CLIENTE
                                </div>

                                <div class="card-body ">
                                    <div class="row justify-content-center mb-3">
                                        <div class="col-sm-5">
                                            <div class="input-group input-group-sm">
                                                <label for="obra" class="col-form-label">CLIENTE:</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="hidden" class="form-control" name="id_clie" id="id_clie" value="<?php echo $id_clie; ?>">
                                                    <input type="text" class="form-control" name="cliente" id="cliente" disabled placeholder="SELECCIONAR CLIENTE" value="<?php echo $cliente; ?>">
                                                   
                                                        <span class="input-group-append">
                                                            <button id="bcliente" type="button" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                                                        </span>
                                                 
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered table-condensed text-nowrap w-auto mx-auto" style="width:100%">
                                    <thead class="text-center bg-gradient-green">
                                        <tr>
                                            <th>FOLIO</th>
                                            <th>FECHA</th>
                                            <th>CONCEPTO</th>
                                            <th>TOTAL</th>
                                            <th>SALDO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($id_clie <> ""){

                                            
                                            foreach($datalotes as $row){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['folio_venta']?></td>
                                            <td><?php echo $row['fecha']?></td>
                                            <td><?php echo $row['concepto']?></td>
                                            <td class="text-right"><?php echo "$ ".number_format($row['total'],2)?></td>
                                            <td class="text-right"><?php echo "$ ".number_format($row['saldo'],2)?></td>
                                            <td></td>
                                        </tr>
                                        <?php 
                                        }
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
 
 <!-- INICIA BUSCAR CLIENTE -->
    <section>
        <div class="container-fluid">

            <!-- Default box -->
            <div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-green">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR CLIENTE</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablaCliente" id="tablaCliente" class="table table-sm  table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center bg-gradient-green">
                                    <tr>
                                       
                                        <th>CLAVE</th>
                                        <th>NOMBRE</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $datc) {
                                    ?>
                                        <tr>
                                           
                                            <td><?php echo $datc['clave'] ?></td>
                                            <td><?php echo $datc['nombre'] ?></td>
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

<script src="fjs/cntacobranza.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>