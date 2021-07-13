    <!-- ======================================================== -->

    <!-- initialize jQuery Library -->
    <script type="text/javascript" src="<?= base_url('assets1/js/jquery.js') ?> "></script>
    <!-- Bootstrap jQuery -->
    <script type="text/javascript" src="<?= base_url('assets1/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets1/sweetalert/sweetalert2.all.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets1/sweetalert/sweetalert.custom.js') ?>"></script>


    <script type="text/javascript" src="<?= base_url('assets1/js/jam.js') ?>"></script>


    <script>
        $(document).ready(function() {
            $('#masuk').click(function() {
                $('#scanBarcode').focus();

            });
            $('#pulang').click(function() {
                $('#scanBarcode').focus();
            });
        });
    </script>
    </body>

    </html>