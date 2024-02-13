
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
                                                            </label>
                                                            <ul class="list-none">
                                                                <?php foreach ($submenus as $submenu): ?>
                                                                    <?php if($submenu["visibilidad_submenu"] != "Ocultar"): ?>
                                                                    <li>
                                                                        <input type="checkbox" id="<?= $submenu['id_menu'] ?>" class="submenu-checkbox">
                                                                            <span><i class="<?= $submenu['icono_submenu'] ?>"></i> <?= $submenu['nombre_submenu'] ?></span>
                                                                        </label>
                                                                    </li>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <input type="checkbox" id="<?= $item['id_menu'] ?>" class="menu-checkbox">
                                                                <span><i class="<?= $item['icono_menu'] ?>"></i> <?= $item['nombre_menu'] ?></span>
                                                            </label>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>
                                    <div class="col-md-8">
                                        <?=$render;?>
                                    </div>
                                </div>
                            
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
                // Toggle all checkboxes when "Marcar Todos" is clicked
                $('.pdocrud-select-all').change(function () {
                    $('.menu-checkbox, .submenu-checkbox').prop('checked', $(this).prop('checked'));
                });

                // Toggle "Marcar Todos" checkbox based on the individual checkboxes
                $('.menu-checkbox, .submenu-checkbox').change(function () {
                    if ($('.menu-checkbox:checked, .submenu-checkbox:checked').length === $('.menu-checkbox, .submenu-checkbox').length) {
                        $('.pdocrud-select-all').prop('checked', true);
                    } else {
                        $('.pdocrud-select-all').prop('checked', false);
                    }
                });

                $(document).on('click', '.asignar_menu_usuario', function () {
                    var userId = $(this).data('id');
                    var selectedMenus = [];

                    // Iterar sobre las casillas marcadas y recopilar datos
                    $('.menu-checkbox:checked, .submenu-checkbox:checked').each(function () {
                        var checkboxId = $(this).attr('id');
                        var menuId = checkboxId.replace('menu', ''); // Extract menuId from checkboxId
                        selectedMenus.push({
                            menuId: menuId
                        });
                    });

                    //Envía datos al servidor usando Ajax
                    $.ajax({
                        url: "<?=$_ENV["BASE_URL"]?>home/asignar_menus_usuario",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            userId: userId,
                            selectedMenus: selectedMenus
                        },
                        success: function (response) {
                            //console.log(response);

                            if(response['success']){
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
                });

            });
        </script>
        <?php require "layouts/footer.php"; ?>