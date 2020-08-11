<?php

use App\Entidades\Banco;
use App\Entidades\Tarjeta;
use App\Factory;
use App\Librerias\Convert;

/**
 * @var  array $datos
 */
$array_tarjeta = $datos[ 'tarjeta' ];
$array_bancos  = $datos[ 'bancos' ];

$ui = Factory::UI();
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Tarjetas de crédito </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li>Tarjetas de crédito</li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12 col-lg-8">
                <div class="box">
                    <div class="box-header with-border">
                        <?= $ui->Button_nuevo()
                               ->set_primario()
                               ->set_modal_abrir('#modal_nueva_tarjeta')
                        ?>
                        <div class="box-body">

                            <table class="table table-bordered table-striped dt-responsive grid">
                                <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Nombre</th>
                                    <th>Banco</th>
                                    <th style="width: 80px">Caduca</th>
                                    <th style="width: 80px">Activo</th>
                                    <th style="width: 40px">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                /**
                                 * @var array $datos
                                 */
                                foreach ($array_tarjeta as $tarjeta) {

                                    $id = $tarjeta[ Tarjeta::FIELD_ID ];

                                    $activada = Convert::to_bool($tarjeta[ Tarjeta::FIELD_ACTIVA ]);

                                    if ($activada) {
                                        $btnActivada = $ui->Button_simple('Activada')
                                                          ->set_color_verde()
                                                          ->set_titulo('Tarjeta activda')
                                                          ->set_size_xs();
                                    } else {
                                        $btnActivada = $ui->Button_simple('Desactivada')
                                                          ->set_size_xs()
                                                          ->set_titulo('Tarjeta desactivada')
                                                          ->set_color_rojo();
                                    }
                                    $btnEditar = $ui->Button_simple_link('')
                                                    ->set_color_naranja()
                                                    ->set_modal_abrir('#modal_editar_tarjeta')
                                                    ->set_icon('fa-pencil')
                                                    ->set_titulo('Modificar')
                                                    ->set_size_xs()
                                                    ->set_class_name('btnEditarTarjeta')
                                                    ->set_tag('data-id', $id);

                                    $btnEliminar = $ui->Button_simple('')
                                                      ->set_color_rojo()
                                                      ->set_icon('fa-times')
                                                      ->set_titulo('Eliminar')
                                                      ->set_size_xs()
                                                      ->set_class_name('btnEliminarTarjeta')
                                                      ->set_tag('data-id', $id);

                                    ?>
                                    <tr>
                                        <td><?= $tarjeta[ Tarjeta::FIELD_ID ] ?></td>
                                        <td class='tarjeta_<?= $id ?>'><?= $tarjeta[ Tarjeta::FIELD_NOMBRE ] ?></td>
                                        <td><?= $tarjeta[ Banco::FIELD_NOMBRE ] ?></td>
                                        <td><?= Convert::to_date_std($tarjeta[ Tarjeta::FIELD_CADUCA ]) ?></td>
                                        <td> <?= $btnActivada ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <?= $btnEditar ?>
                                                <?= $btnEliminar ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
        </section>
    </div>

<?php

include '_nuevo.php';
include '_editar.php';