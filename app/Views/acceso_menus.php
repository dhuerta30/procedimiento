
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
                                                <span>Marcar Todos</span>
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
                                                            <input type="checkbox" id="menu<?= $item['id_menu'] ?>" class="menu-checkbox">
                                                                <span><i class="<?= $item['icono_menu'] ?>"></i> <?= $item['nombre_menu'] ?></span>
                                                            </label>
                                                            <ul class="list-none">
                                                                <?php foreach ($submenus as $submenu): ?>
                                                                    <?php if($submenu["visibilidad_submenu"] != "Ocultar"): ?>
                                                                    <li>
                                                                        <input type="checkbox" id="submenu<?= $submenu['id_submenu'] ?>" class="submenu-checkbox">
                                                                            <span><i class="<?= $submenu['icono_submenu'] ?>"></i> <?= $submenu['nombre_submenu'] ?></span>
                                                                        </label>
                                                                    </li>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <input type="checkbox" id="menu<?= $item['id_menu'] ?>" class="menu-checkbox">
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
            });
        </script>
        <?php require "layouts/footer.php"; ?>