<?php

use App\Entidades\Banco;
use App\Librerias\Convert;

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

                        <a title="Crear un nuevo banco"
                           class="btn btn-flat btn-primary"
                           data-toggle="modal"
                           data-target="#modal_nuevo_banco">Nuevo</a>

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
                                        $btnEstado = '<a title="Banco activado" class="btn btn-flat btn-success btn-xs">Activado</a>';
                                    } else {
                                        $btnEstado = '<a title="Banco desactivado" class="btn btn-flat btn-danger btn-xs">Desactivado</a>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $id ?></td>
                                        <td class='banco_<?= $id ?>'><?= $array_banco[ Banco::FIELD_NOMBRE ] ?></td>
                                        <td><?= $btnEstado ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a title="Modificar"
                                                   href="#"
                                                   data-id="<?= $id ?>"
                                                   class="btn btn-flat btn-warning btn-xs btnEditarBanco"
                                                   data-toggle="modal"
                                                   data-target="#modal_editar_banco">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a title="Eliminar"
                                                   href="#"
                                                   data-id="<?= $id ?>"
                                                   class="btn btn-flat btn-danger btn-xs btnEliminarBanco">
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