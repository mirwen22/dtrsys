<!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>template/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>template/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Sweet alert -->
    <script src="<?php echo base_url() ?>template/js/plugins/sweetalert/sweetalert_updated.min.js"></script>
    
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>template/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>template/js/plugins/pace/pace.min.js"></script>

    <script src="<?php echo base_url() ?>template/js/plugins/dataTables/datatables.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url() ?>template/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Ladda -->
    <script src="<?php echo base_url() ?>template/js/plugins/ladda/spin.min.js"></script>
    <script src="<?php echo base_url() ?>template/js/plugins/ladda/ladda.min.js"></script>
    <script src="<?php echo base_url() ?>template/js/plugins/ladda/ladda.jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });


            $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });


    $(document).ready(function (){

          $("#myform").on("submit", function(){
            var l = $( '.ladda-button-submit' ).ladda();
            l.ladda( 'start' );
            
          });//submit

    });

    </script>
</body>

</html>