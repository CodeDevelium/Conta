<?php

use App\App;

?>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Code Develium
    </div>
    <strong>Copyright &copy; <?= date('Y') ?>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="/assets/bower_components/jquery.blockui.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!--<script src="/assets/dist/js/demo.js"></script>-->
<script src="/scripts/app.js"></script>
<?php

$js = $this->get_file_js();
if (!empty($js)) {
    $path_js = App::$Config->get_path_document_root().$js;
    if (file_exists($path_js)) {
        $http_js = App::$Config->get_http_server_name().$js;
        echo "<script src=\"{$http_js}\"></script>";
    }
}
?>
</body>
</html>
