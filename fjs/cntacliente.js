$(document).ready(function () {
    var id, opcion
    opcion = 4
  
    // TOOLTIP DATATABLE
    $('[data-toggle="tooltip"]').tooltip()
  
    tablaVis = $('#tablaV').DataTable({
  
      dom:
      "<'row justify-content-center'<'col-sm-12 col-md-4 form-group'l><'col-sm-12 col-md-4 form-group'B><'col-sm-12 col-md-4 form-group'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  
    buttons: [
      {
        extend: 'excelHtml5',
        text: "<i class='fas fa-file-excel'> Excel</i>",
        titleAttr: 'Exportar a Excel',
        title: 'Listado de Proveedores',
        className: 'btn bg-success ',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'pdfHtml5',
        text: "<i class='far fa-file-pdf'> PDF</i>",
        titleAttr: 'Exportar a PDF',
        title: 'Listado de Proveedores',
        className: 'btn bg-danger',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
    ],
  
      columnDefs: [
        {
          targets: -1,
          data: null,
          defaultContent:
            "<div class='text-center'><button class='btn btn-sm btn-primary btnEditar' data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-edit'></i></button>\
                                  <button class='btn btn-sm btn-danger btnBorrar' data-toggle='tooltip' data-placement='top' title='Eliminar'><i class='fas fa-trash-alt'></i></button></div>",
        },
     
      ],
  
      //Para cambiar el lenguaje a español
      language: {
        lengthMenu: 'Mostrar _MENU_ registros',
        zeroRecords: 'No se encontraron resultados',
        info:
          'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
        infoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
        infoFiltered: '(filtrado de un total de _MAX_ registros)',
        sSearch: 'Buscar:',
        oPaginate: {
          sFirst: 'Primero',
          sLast: 'Último',
          sNext: 'Siguiente',
          sPrevious: 'Anterior',
        },
        sProcessing: 'Procesando...',
      },
    })
  
      //FILTROS
      $('#tablaV thead tr').clone(true).appendTo('#tablaV thead')
      $('#tablaV thead tr:eq(1) th').each(function (i) {
        var title = $(this).text()
        $(this).html(
          '<input class="form-control form-control-sm" type="text" placeholder="' +
            title +
            '" />',
        )
    
        $('input', this).on('keyup change', function () {
          if (i == 4) {
            valbuscar = this.value
          } else {
            valbuscar = this.value
          }
    
          if (tablaVis.column(i).search() !== valbuscar) {
            tablaVis.column(i).search(valbuscar, true, true).draw()
          }
        })
      })
  
    //BONTON NUEVO
    $('#btnNuevo').click(function () {
      //window.location.href = "prospecto.php";
      $('#formDatos').trigger('reset')
      $('.modal-header').css('background-color', '#28a745')
      $('.modal-header').css('color', 'white')
      $('.modal-title').text('NUEVO CLIENTE')
      $('#modalCRUD').modal('show')
      id = null
      opcion = 1
    })
  
    var fila
  
    //BOTON EDITAR
    $(document).on('click', '.btnEditar', function () {
      fila = $(this).closest('tr')
      id = fila.find('td:eq(0)').text()
  
      rfc = fila.find('td:eq(1)').text()
      razon = fila.find('td:eq(2)').text()
      dir = fila.find('td:eq(3)').text()
      tel = fila.find('td:eq(4)').text()
      contacto = fila.find('td:eq(5)').text()
      tel_contacto = fila.find('td:eq(6)').text()
      especialidad = fila.find('td:eq(7)').text()
  
      $('#clave').val(id)
      $('#rfc').val(rfc)
      $('#razon').val(razon)
      $('#dir').val(dir)
      $('#tel').val(tel)
      $('#contacto').val(contacto)
      $('#tel_contacto').val(tel_contacto)
      $('#especialidad').val(especialidad)
      opcion = 2 //editar
  
      $('.modal-header').css('background-color', '#007bff')
      $('.modal-header').css('color', 'white')
      $('.modal-title').text('EDITAR CLIENTE')
      $('#modalCRUD').modal('show')
    })
  
    //BOTON BORRAR
    $(document).on('click', '.btnBorrar', function () {
      fila = $(this)
  
      id = parseInt($(this).closest('tr').find('td:eq(0)').text())
      opcion = 3
      swal
        .fire({
          title: 'ELIMINAR',
          text: '¿Desea eliminar el registro seleccionado?',
          showCancelButton: true,
          icon: 'question',
          focusConfirm: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#28B463',
          cancelButtonColor: '#d33',
        })
        .then(function (isConfirm) {
          if (isConfirm.value) {
            $.ajax({
              url: 'bd/crudproveedor.php',
              type: 'POST',
              dataType: 'json',
              data: { id: id, opcion: opcion },
              success: function (data) {
                tablaVis.row(fila.parents('tr')).remove().draw()
              },
            })
          } else if (isConfirm.dismiss === swal.DismissReason.cancel) {
          }
        })
    })
  
    //GUARDAR PROVEEDOR
  
    $(document).on('click', '#btnGuardar', function () {
      
      var clave = $('#clave').val()
      var rfc = $('#rfc').val()
      var folio = $('#folio').val()
      var razon = $('#razon').val()
      var calle = $('#calle').val()
      var colonia = $('#colonia').val()
      var cp = $('#cp').val()
      var ciudad = $('#ciudad').val()
      var estado = $('#estado').val()
      var telm = $('#telm').val()
      var telc = $('#telc').val()
      var telt = $('#telt').val()
      var correo = $('#correo').val()
      var nacionalidad = $('#nacionalidad').val()
      var edoc = $('#edoc').val()
      var banco = $('#banco').val()
      var cuenta = $('#cuenta').val()
  
      if (razon.length == 0 || telc.length == 0) {
        Swal.fire({
          title: 'Datos Faltantes',
          text: 'Debe ingresar todos los datos del Prospecto',
          icon: 'warning',
        })
        return false
      } else {
        $.ajax({
          url: 'bd/crudcliente.php',
          type: 'POST',
          dataType: 'json',
          data: {
            clave: clave,
            rfc: rfc,
            folio: folio,
            razon: razon,
            calle: calle,
            colonia: colonia,
            cp: cp,
            ciudad: ciudad,
            estado: estado,
            telm: telm,
            telc: telc,
            telt: telt,
            correo: correo,
            nacionalidad: nacionalidad,
            edoc: edoc,
            banco: banco,
            cuenta: cuenta,
            opcion: opcion,
          },
          success: function (data) {
        


            id = data[0].clave
            rfc = data[0].rfc,
            razon = data[0].nombre,
            telm = data[0].tel_cel,
            correo = data[0].email
            
            if (opcion == 1) {
              tablaVis.row
                .add([
                  id,
                  rfc,
                  razon,
                  telm,
                  correo,
                  
                ])
                .draw()
            } else {
              tablaVis
                .row(fila)
                .data([
                  id,
                  rfc,
                  razon,
                  telm,
                  correo,
                ])
                .draw()
            }

            Swal.fire({
              title: 'OPERACION EXITOSA',
              text: 'Registro Guardado',
              icon: 'success',
            })
          },
          error: function(){
            Swal.fire({
              title: 'Error',
              text: 'Error en funcion',
              icon: 'error',
            })
          }
        })
        $('#modalCRUD').modal('hide')
      }
    })
  


  })
  