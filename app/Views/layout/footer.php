</div>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<aside class="control-sidebar control-sidebar-dark">

</aside>

</div>

<!-- Bootstrap JS  -->
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Select JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script src="<?php echo base_url(); ?>/assets/dist/js/adminlte.min.js?v=3.2.0"></script>
<!-- <script src="<?php echo base_url(); ?>/assets/dist/js/demo.js"></script> -->

<!-- PLUGINS DATATABLES -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- FIN PLUGINS DATATABLES -->

<!-- PLUGINS PARA EXPORTAR REPORTES -->
<script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<!-- SELECT PICKER -->
<script src="https://cdn.jsdelivr.net/npm/select-picker@0.3.2/dist/picker.min.js"></script>
<!-- SWEETALERT2.js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- MENSAJES TOAST -->
<script src="<?php echo base_url(); ?>assets/dist/js/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/funciones_globales.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/plantilla.js"></script>

</body>

<script>
    $(document).ready(function() {
        // Esta línea obtiene la URL actual de la ventana del navegador.
        var currentUrl = window.location.pathname;

        // Ahora iteramos sobre todos los elementos de la lista de la barra lateral.
        $('.nav-sidebar .nav-item').each(function() {
            var $this = $(this);
            var menuUrl = $this.data('url') || $this.find('a').attr('href');

            // Si la URL del menú coincide con la URL actual, marcamos el menú como activo.
            if (currentUrl.includes(menuUrl)) {
                $this.addClass('active'); // Añade la clase 'active' al elemento actual
                $this.children('a').addClass('active'); // Añade la clase 'active' al enlace directo
                $this.parent('.nav-treeview').css('display', 'block'); // Asegúrate de que el menú esté abierto
                $this.parents('.nav-item').addClass('menu-open'); // Añade la clase 'menu-open' al elemento padre

                // Si es un menú de nivel superior, también debemos abrirlo.
                if ($this.hasClass('has-treeview')) {
                    $this.addClass('menu-open');
                }
            }
        });
    });
</script>

</html>