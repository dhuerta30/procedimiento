<?php require "layouts/header.php"; ?>
<?php require 'layouts/sidebar.php'; ?>
<link href="<?=$_ENV["BASE_URL"]?>css/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=$_ENV["BASE_URL"]?>css/flatpickr.min.css">
<style>
    .page-title.clearfix.card-header.pdocrud-table-heading, .row.pdocrud-options-files {
        display: none;
    }
    .pdocrud-search {
        display: none!important;
    }
</style>
<div class="content-wrapper">
	<section class="content">
		<div class="card mt-4">
			<div class="card-body">
				<div class="row mb-3">
				</div>
				<h5>Búsqueda Lista Espera Exámenes</h5>
				<hr>

				<div class="examenes">
					<?=$render?>
                    <?=$mask;?>
				</div>

                <div class="resultados"></div>

                <div class="cargar_modal"></div>
			</div>
		</div>
	</section>
</div>
<div id="pdocrud-ajax-loader">
	<img width="300" src="<?=$_ENV["BASE_URL"]?>app/libs/script/images/ajax-loader.gif" class="pdocrud-img-ajax-loader"/>
</div>
<script src="<?=$_ENV["BASE_URL"]?>js/sweetalert2.all.min.js"></script>
<script src="<?=$_ENV["BASE_URL"]?>js/flatpickr.js"></script>
<script>
$(document).ready(function(){
    $(".fecha_solicitud").flatpickr({
        dateFormat: "d-m-Y",
        allowInput: true,
        //defaultDate: new Date(),
        locale: {
            firstDayOfWeek: 1, // Lunes como primer día de la semana
            weekdays: {
                shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                longhand: [
                    'Domingo',
                    'Lunes',
                    'Martes',
                    'Miércoles',
                    'Jueves',
                    'Viernes',
                    'Sábado'
                ]
            },
            months: {
                shorthand: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                ],
                longhand: [
                    'Enero',
                    'Febrero',
                    'Marzo',
                    'Abril',
                    'Mayo',
                    'Junio',
                    'Julio',
                    'Agosto',
                    'Septiembre',
                    'Octubre',
                    'Noviembre',
                    'Diciembre'
                ]
            }
        }
    });
});


$(document).on("click", ".buscar", function(){
    let run = $('.rut').val();
    let nombre_paciente = $('.nombre_paciente').val();
    let estado = $('.estado').val();
    let prestacion = $('.prestacion').val();
    let profesional = $('.profesional').val();
    let fecha_solicitud = $('.fecha_solicitud').val();

    $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"]?>home/buscar_examenes",
        dataType: "html",
        data: {
            run: run,
            nombre_paciente: nombre_paciente,
            estado: estado,
            prestacion: prestacion,
            profesional: profesional,
            fecha_solicitud: fecha_solicitud
        },
        beforeSend: function() {
            $("#pdocrud-ajax-loader").show();
        },
        success: function(data){
            $("#pdocrud-ajax-loader").hide();
            $('.resultados').html(data);
        }
    });

});

$(document).on("click", ".limpiar_filtro", function(){
    $('.rut').val("");
    $('.nombre_paciente').val("");
    $('.estado').val("");
    $('.prestacion').val("");
    $('.profesional').val("");
    $('.fecha_solicitud').val("");
    $('.resultados').empty();
    $('.cargar_modal').empty();
});


$(document).on("click", ".egresar_solicitud", function(){
    let id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"]?>home/cargar_modal_egresar_solicitud",
        dataType: "html",
        data: {
            id: id
        },
        beforeSend: function() {
            $("#pdocrud-ajax-loader").show();
        },
        success: function(data){
            $("#pdocrud-ajax-loader").hide();
            $('.cargar_modal').html(data);
            $('#egresar_solicitud').modal('show');

            $(".fecha_egreso").flatpickr({
                dateFormat: "d-m-Y",
                allowInput: true,
                //defaultDate: new Date(),
                locale: {
                    firstDayOfWeek: 1, // Lunes como primer día de la semana
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                        longhand: [
                            'Domingo',
                            'Lunes',
                            'Martes',
                            'Miércoles',
                            'Jueves',
                            'Viernes',
                            'Sábado'
                        ]
                    },
                    months: {
                        shorthand: [
                            'Ene',
                            'Feb',
                            'Mar',
                            'Abr',
                            'May',
                            'Jun',
                            'Jul',
                            'Ago',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dic'
                        ],
                        longhand: [
                            'Enero',
                            'Febrero',
                            'Marzo',
                            'Abril',
                            'Mayo',
                            'Junio',
                            'Julio',
                            'Agosto',
                            'Septiembre',
                            'Octubre',
                            'Noviembre',
                            'Diciembre'
                        ]
                    }
                }
            });

        }
    });
});

$(document).on("click", ".procedimientos", function(){
    let id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"]?>home/cargar_modal_procedimientos",
        dataType: "html",
        data: {
            id: id
        },
        beforeSend: function() {
            $("#pdocrud-ajax-loader").show();
        },
        success: function(data){
            $("#pdocrud-ajax-loader").hide();
            $('.cargar_modal').html(data);
            $('#procedimientos').modal('show');

            $(".fecha").flatpickr({
                dateFormat: "Y-m-d",
                allowInput: true,
                //defaultDate: new Date(),
                locale: {
                    firstDayOfWeek: 1, // Lunes como primer día de la semana
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                        longhand: [
                            'Domingo',
                            'Lunes',
                            'Martes',
                            'Miércoles',
                            'Jueves',
                            'Viernes',
                            'Sábado'
                        ]
                    },
                    months: {
                        shorthand: [
                            'Ene',
                            'Feb',
                            'Mar',
                            'Abr',
                            'May',
                            'Jun',
                            'Jul',
                            'Ago',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dic'
                        ],
                        longhand: [
                            'Enero',
                            'Febrero',
                            'Marzo',
                            'Abril',
                            'Mayo',
                            'Junio',
                            'Julio',
                            'Agosto',
                            'Septiembre',
                            'Octubre',
                            'Noviembre',
                            'Diciembre'
                        ]
                    }
                }
            });
        }
    });
});


$(document).on("click", ".agregar_notas", function(){
    let id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"]?>home/cargar_modal_agregar_nota",
        dataType: "html",
        data: {
            id: id
        },
        beforeSend: function() {
            $("#pdocrud-ajax-loader").show();
        },
        success: function(data){
            $("#pdocrud-ajax-loader").hide();
            $('.cargar_modal').html(data);
            $('#agregar_nota').modal('show');
        }
    });
});

$(document).on("click", ".ver_logs", function(){
    let id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "<?=$_ENV["BASE_URL"]?>home/cargar_modal_logs",
        dataType: "html",
        data: {
            id: id
        },
        beforeSend: function() {
            $("#pdocrud-ajax-loader").show();
        },
        success: function(data){
            $("#pdocrud-ajax-loader").hide();
            $('.cargar_modal').html(data);
            $('#logs').modal('show');
        }
    });
});

$(document).on('click', '.imprimir_solicitud', function () {
    let id = $(this).data('id');
    window.open("<?=$_ENV["BASE_URL"]?>home/imprimir_solicitud/index.php?id=" + id);
});

$(document).on("pdocrud_before_ajax_action", function(event, obj, data){
    $('.titulo_modal').html(`
        <i class="fa fa-file-o"></i> Agregar Nota
    `);
});

$(document).on("pdocrud_after_submission", function(event, obj, data){
    let json = JSON.parse(data);

    if(json.message){
        $('#pdocrud_search_btn').click();
        $('#procedimientos').modal('hide');
        $('#egresar_solicitud').modal('hide');
        $('#agregar_nota').modal('hide');

        Swal.fire({
            title: 'Genial!',
            text: json.message,
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    }

});
</script>
<?php require 'layouts/footer.php'; ?>