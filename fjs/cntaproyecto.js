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
          "<div class='text-center'><div class='btn-group'>\
            <button class='btn btn-sm btn-primary  btnEditar'><i class='fas fa-edit'></i></button>\
            <button class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>\
            </div></div>",
      },
      { className: 'hide_column', targets: [3] },
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

  tablaclie = $('#tablaEmpresa').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelEmp'><i class='fas fa-hand-pointer'></i></button></div></div>",
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
    //window.location.href = "prospecto.php";
    $('#formDatos').trigger('reset')
    $('#id_proyecto').val(0)
    $('#modalCRUD').modal('show')
    id = null
    opcion = 1 //alta
  })

  $(document).on('click', '#bempresa', function () {
    $('#modalEmpresa').modal('show')
  })

  $(document).on('click', '.btnSelEmp', function () {
    fila = $(this)
    id_emp = parseInt($(this).closest('tr').find('td:eq(0)').text())
    empresa = $(this).closest('tr').find('td:eq(2)').text()

    $('#id_emp').val(id_emp)
    $('#empresa').val(empresa)
    $('#modalEmpresa').modal('hide')
  })

  $(document).on('click', '#btnGuardar', function () {
    id_proyecto = $('#id_proyecto').val()
    clave = $('#clave').val()
    id_emp = $('#id_emp').val()
    empresa = $('#empresa').val()
    nombre = $('#nombre').val()

    if (clave.length == 0 || id_emp.length == 0 || nombre.length == 0) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos Requeridos',
        icon: 'warning',
      })
      return false
    } else {
  
      $.ajax({
        url: 'bd/crudproyecto.php',
        type: 'POST',
        dataType: 'json',
        data: {
          id_proyecto: id_proyecto,
          clave: clave,
          id_emp: id_emp,
          empresa:empresa,
          nombre: nombre,
          opcion: opcion,
        },
        success: function (data) {
          if (data == 1) {
            mensaje()
            window.location.reload()
          } else {
            Swal.fire({
              title: 'Operacion No Exitosa',
              icon: 'warning',
            })
          }
        },
      })
    }
  })

  function mensaje() {
    swal.fire({
      title: 'Operación Exitosa',
      icon: 'success',
      focusConfirm: true,
      confirmButtonText: 'Aceptar',
      timer: 2000,
    })
  }
})
