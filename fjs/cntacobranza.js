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
            "<div class='text-center'>\
                <button class='btn btn-sm btn-primary btnDetalle'><i class='fa-solid fa-magnifying-glass-dollar'></i></button>\
            </div>",
        },
      ],
      paging:false,
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


    tablacliente = $('#tablaCliente').DataTable({
        columnDefs: [
          {
            targets: -1,
            data: null,
            defaultContent:
              "<div class='text-center'>\
                <button class='btn btn-sm btn-success btnSelClie' data-toggle='tooltip' data-placement='top' title='Seleccionar Cliente'><i class='fas fa-hand-pointer'></i></button>\
                </div>",
          },
        ],
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
    
  
    $('#bcliente').click(function () {
        $('#modalCliente').modal('show')  
     
    })
  
    
    $(document).on('click', '.btnDetalle', function () {
      fila = $(this).closest('tr')
      id = parseInt(fila.find('td:eq(0)').text())
  
     //window.location.href = "ordencompra.php?folio=" + id;
   
    })
  
    $(document).on('click', '.btnSelClie', function () {
        fila = $(this)
        id_clie = $(this).closest('tr').find('td:eq(0)').text()
       
        window.location.href = 'cntacobranza.php?id_clie=' + id_clie
    
      })



  })
  