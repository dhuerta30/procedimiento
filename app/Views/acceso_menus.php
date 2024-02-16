
        <?php require "layouts/header.php"; ?>
        <?php require "layouts/sidebar.php"; ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="card mt-4">
                    <div class="card-body">

                        <div class="row procedimiento">
                            <div class="col-md-12">
                                <h5>Accesos Usuarios a Menus</h5>
                                <hr>

                                <div class="row">
                                    <div class="col-md-3 m-auto">

                                        <ul class="list-none">
                                            <li>
                                                <input type="checkbox" value="select-all" name="pdocrud_select_all" class="pdocrud-select-all">
                                                <span>Marcar Todos / Desmarcar Todos</span>
                                            </li>
                                        </ul>

                                        <div class="menu_list">
                                            <ul class="list-none">
                                                <?php foreach ($menu as $item): ?>
                                                    <?php if (($_SESSION["usuario"][0]["idrol"] == 1 || $item["nombre_menu"] != "usuarios") && $item["visibilidad_menu"] != "Ocultar" ): ?>
                                                        <?php
                                                            // Obtiene submenús
                                                            $submenus = App\Controllers\HomeController::submenuDB($item['id_menu']);
                                                            $tieneSubmenus = ($item["submenu"] == "Si");
                                                            $subMenuAbierto = false;

                                                            // Verifica si algún submenú está activo
                                                            foreach ($submenus as $submenu) {
                                                                if (strpos($current_url, $submenu['url_submenu']) !== false) {
                                                                    $subMenuAbierto = true;
                                                                    break;
                                                                }
                                                            }
                                                        ?>
                                                        <li>
                                                            <?php if ($tieneSubmenus): ?>
                                                                <input type="checkbox" id="<?= $item['id_menu'] ?>" class="menu-checkbox">
                                                                    <span><i class="<?= $item['icono_menu'] ?>"></i> <?= $item['nombre_menu'] ?></span>
                                                                <ul class="list-none">
                                                                    <?php foreach ($submenus as $submenu): ?>
                                                                        <?php if($submenu["visibilidad_submenu"] != "Ocultar"): ?>
                                                                        <li>
                                                                            <input type="checkbox" id="<?= $submenu['id_submenu'] ?>" class="submenu-checkbox">
                                                                                <span><i class="<?= $submenu['icono_submenu'] ?>"></i> <?= $submenu['nombre_submenu'] ?></span>
        
                                                                        </li>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <input type="checkbox" id="<?= $item['id_menu'] ?>" class="menu-checkbox">
                                                                    <span><i class="<?= $item['icono_menu'] ?>"></i> <?= $item['nombre_menu'] ?></span>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <?=$render;?>
                                    </div>
                                </div>

                                <div class="cargar_modal"></div>
                            
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
        <div id="pdocrud-ajax-loader">
            <img width="300" src="<?=$_ENV["BASE_URL"]?>app/libs/script/images/ajax-loader.gif" class="pdocrud-img-ajax-loader"/>
        </div>
        <script src="<?=$_ENV["BASE_URL"]?>js/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.pdocrud-select-all').change(function () {
                    $('.menu-checkbox, .submenu-checkbox').prop('checked', $(this).prop('checked'));
                });

                $('.menu-checkbox, .submenu-checkbox').change(function () {
                    if ($('.menu-checkbox:checked, .submenu-checkbox:checked').length === $('.menu-checkbox, .submenu-checkbox').length) {
                        $('.pdocrud-select-all').prop('checked', true);
                    } else {
                        $('.pdocrud-select-all').prop('checked', false);
                    }
                });

                $(document).on('click', '.asignar_menu_usuario', function () {
                    var userId = $(this).data('id');
                    var checkboxValues = {};

                    // Iterar sobre las casillas marcadas y recopilar datos
                    $('.menu-checkbox, .submenu-checkbox').each(function () {
                        var checkboxId = $(this).attr('id');
                        var isChecked = $(this).prop('checked');

                        checkboxValues[checkboxId] = {
                            checked: isChecked,
                            menuId: checkboxId
                        };
                    });


                    var selectedMenus = Object.values(checkboxValues).filter(function (checkbox) {
                        return checkbox.checked;
                    });

                    if (selectedMenus.length > 0) {
                        //Envía datos al servidor usando Ajax
                        $.ajax({
                            url: "<?=$_ENV["BASE_URL"]?>home/asignar_menus_usuario",
                            type: 'POST',
                            dataType: "json",
                            data: {
                                userId: userId,
                                selectedMenus: checkboxValues
                            },
                            beforeSend: function() {
                                $("#pdocrud-ajax-loader").show();
                            },
                            success: function (response) {
                                $("#pdocrud-ajax-loader").hide();
                                if(response['success']){
                                    $('.pdocrud-select-all').removeAttr('checked', false);
                                    $('.menu-checkbox').removeAttr('checked', false);
                                    $('#menus').modal('hide');
                                    Swal.fire({
                                        title: "Genial!",
                                        text: response['success'],
                                        icon: "success",
                                        confirmButtonText: "Aceptar"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Lo siento!",
                                        text: response['error'],
                                        icon: "error",
                                        confirmButtonText: "Aceptar"
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Atención!",
                            text: 'Selecciona al menos un menu de la izquierda antes de guardar',
                            icon: "warning",
                            confirmButtonText: "Aceptar"
                        });
                    }
                });


                $(document).on("click", ".ver_menu_usuario", function(){
                    var userId = $(this).data('id');

                    $.ajax({
                        type: "POST",
                        url: "<?=$_ENV["BASE_URL"]?>home/obtener_menu_usuario",
                        dataType: "html",
                        data: {
                            userId: userId
                        },
                        beforeSend: function() {
                            $("#pdocrud-ajax-loader").show();
                        },
                        success: function(data){
                            $("#pdocrud-ajax-loader").hide();
                            $('.cargar_modal').html(data);
                            $('#menus').modal('show');
                            //console.log(data);
                        }
                    });
                });

                

            });
        </script>
        <?php require "layouts/footer.php"; ?>