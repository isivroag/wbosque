$(document).ready(function () {
  var id, opcion
  opcion = 4
  var fila

  tablaVis = $('#tablaV').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><button class='btn btn-sm btn-primary  btnEditar'><i class='fas fa-edit'></i></button>\
            <button class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div>",
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

  $('#btnNuevo').click(function () {
    $('#formDatos').trigger('reset')

    $('#modalCRUD').modal('show')
    id = null
    opcion = 1
  })

  $(document).on('click', '.btnEditar', function () {
    fila = $(this).closest('tr')
    id = parseInt(fila.find('td:eq(0)').text())

    rfc = fila.find('td:eq(1)').text()
    razon = fila.find('td:eq(2)').text()
    dir = fila.find('td:eq(3)').text()

    $('#rfc').val(rfc)
    $('#razon').val(razon)

    $('#dir').val(dir)

    opcion = 2 //editar

    $('.modal-title').text('EDITAR EMPRESA')
    $('#modalCRUD').modal('show')
  })

  //botón BORRAR
  $(document).on('click', '.btnBorrar', function () {
    fila = $(this)

    id = parseInt($(this).closest('tr').find('td:eq(0)').text())
    opcion = 3 //borrar

    //agregar codigo de sweatalert2
    var respuesta = confirm('¿Está seguro de eliminar el registro: ' + id + '?')

    if (respuesta) {
      $.ajax({
        url: 'bd/crudempresa.php',
        type: 'POST',
        dataType: 'json',
        data: { id: id, opcion: opcion },

        success: function (data) {
          console.log(fila)

          tablaVis.row(fila.parents('tr')).remove().draw()
        },
      })
    }
  })

  $('#formDatos').submit(function (e) {
    e.preventDefault()
    id = $('#id').val()
    clave = $('#clave').val()

    concepto = $('#concepto').val()
    unidad = $('#unidad').val()

    if (concepto.length == 0 || unidad.length == 0) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos del Prospecto',
        icon: 'warning',
      })
      return false
    } else {
      $.ajax({
        url: 'bd/crudconcepto.php',
        type: 'POST',
        dataType: 'json',
        data: {
          id: id,
          clave: clave,
          concepto: concepto,
          unidad: unidad,
          id: id,
          opcion: opcion,
        },
        success: function (data) {
            if(data==1){
                window.location.reload()
            }else{
                Swal.fire({
                    title: 'Operacion No Exitosa',
                    icon: 'warning',
                  })
            }
         
        },
      })
      $('#modalCRUD').modal('hide')
    }
  })
})
