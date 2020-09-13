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
                        <a title="Nueva tarjeta"
                           class="btn btn-flat btn-primary"
                           data-toggle="modal"
                           data-target="#modal_nueva_tarjeta">Nuevo</a>
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
                                        $btnEstado = '<a title="Tajeta activada" class="btn btn-flat btn-success btn-xs">Activada</a>';
                                    } else {
                                        $btnEstado = '<a title="Tarjeta desactivado" class="btn btn-flat btn-danger btn-xs">Desactivada</a>';
                                    }

                                    ?>
                                    <tr>
                                        <td><?= $tarjeta[ Tarjeta::FIELD_ID ] ?></td>
                                        <td class='tarjeta_<?= $id ?>'><?= $tarjeta[ Tarjeta::FIELD_NOMBRE ] ?></td>
                                        <td><?= $tarjeta[ Banco::FIELD_NOMBRE ] ?></td>
                                        <td><?= Convert::to_date_std($tarjeta[ Tarjeta::FIELD_CADUCA ]) ?></td>
                                        <td> <?= $btnEstado ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a title="Modificar"
                                                   href="#"
                                                   data-id="<?= $id ?>"
                                                   class="btn btn-flat btn-warning btn-xs btnEditarTarjeta"
                                                   data-toggle="modal"
                                                   data-target="#modal_editar_tarjeta">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a title="Eliminar"
                                                   href="#"
                                                   data-id="<?= $id ?>"
                                                   class="btn btn-flat btn-danger btn-xs btnEliminarTarjeta">
                                                    <i class="fa fa-times"></i>
                                                </a>
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