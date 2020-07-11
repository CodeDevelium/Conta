<?php

use App\Entidades\Banco;
use App\Factory;
use App\Librerias\Convert;

$ui = Factory::UI();
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Bancos </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li>Bancos</li>
            </ol>
        </section>

        <section class="content">
            <div class="col-md-12 col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <?= $ui->Button_nuevo()
                               ->set_primario()
                               ->set_modal_abrir('#modal_nuevo_banco')
                        ?>
                        <div class="box-body">

                            <table class="table table-bordered table-striped dt-responsive grid">
                                <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Nombre</th>
                                    <th style="width: 100px">Activo</th>
                                    <th style="width: 40px">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                /**
                                 * @var array $datos
                                 */
                                foreach ($datos as $array_banco) {

                                    $id = $array_banco[ Banco::FIELD_ID ];

                                    $activado = Convert::to_bool($array_banco[ Banco::FIELD_ACTIVO ]);

                                    if ($activado) {
                                        $btnActivado = $ui->Button_simple('Activado')
                                                          ->set_color_verde()
                                                          ->set_titulo('Banco activado')
                                                          ->set_size_xs();
                                    } else {
                                        $btnActivado = $ui->Button_simple('Desactivado')
                                                          ->set_size_xs()
                                                          ->set_titulo('Banco desactivado')
                                                          ->set_color_rojo();
                                    }
                                    $btnEditar = $ui->Button_simple_link('')
                                                    ->set_color_naranja()
                                                    ->set_modal_abrir('#modal_editar_banco')
                                                    ->set_icon('fa-pencil')
                                                    ->set_titulo('Modificar')
                                                    ->set_size_xs()
                                                    ->set_class_name('btnEditarBanco')
                                                    ->set_tag('data-id', $id);

                                    $btnEliminar = $ui->Button_simple('')
                                                      ->set_color_rojo()
                                                      ->set_icon('fa-times')
                                                      ->set_titulo('Eliminar')
                                                      ->set_size_xs()
                                                      ->set_class_name('btnEliminarBanco')
                                                      ->set_tag('data-id', $id);

                                    ?>
                                    <tr>
                                        <td><?= $array_banco[ Banco::FIELD_ID ] ?></td>
                                        <td class='banco_".$id."'><?= $array_banco[ Banco::FIELD_NOMBRE ] ?></td>
                                        <td> <?= $btnActivado ?></td>
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