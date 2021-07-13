<!-- Page Footer-->
<footer class="main-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <p>Sistem informasi Absensi &copy; <?= date('Y') ?></p>
      </div>
      <div class="col-sm-6 text-right">
        <p>Design by <a class="external" href="https://webskita.com/">RchPutra</a></p>
      </div>
    </div>
  </div>
</footer>
</div>
</div>
</div>



<!-- JavaScript files-->
<script type="text/javascript" src="<?= base_url('assets1/js/popper.min.js'); ?> "></script>
<script type="text/javascript" src="<?= base_url('assets1/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/sweetalert/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/sweetalert/sweetalert.custom.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/datatables/jquery.dataTables.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('assets1/js/jam.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/js/datatables-demo.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/select2/js/select2.min.js') ?> "></script>
<script type="text/javascript" src="<?= base_url('assets1/js/front.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets1/js/jquery.inputmask.bundle.js'); ?>"></script>

<script>
function readURL(e) {
  var a = e.value,
    r = a.substring(a.lastIndexOf(".") + 1).toLowerCase();
  if (e.files && e.files[0] && ("gif" == r || "png" == r || "jpeg" == r || "jpg" == r)) {
    var i = new FileReader;
    i.onload = function(e) {
      $(".imagepreview").attr("src", e.target.result)
    }, i.readAsDataURL(e.files[0])
  } else $(".imagepreview").attr()
}
</script>
<script type="text/javascript">
$(".btnUploadImage").click(function() {
  $(".btnUploadImage2").click()
}), $(".btnUploadImage1").click(function() {
  $(".btnUploadImage3").click()
}), $(document).ready(function() {
  $(".select2").select2()
}), $(function() {
  $('[data-toggle="tooltip"]').tooltip()
}), $(function() {
  $('[data-toggle1="tooltip"]').tooltip()
})
</script>
<script>
$(".input-telp").inputmask({
  prefix: "0",
  radixPoint: "",
  groupSeparator: "-",
  alias: "numeric",
  autoGroup: !0,
  digits: 0
})
</script>
<script>
$(".input-rupiah").inputmask({
  prefix: "",
  radixPoint: ",",
  groupSeparator: ".",
  alias: "numeric",
  autoGroup: !0,
  digits: 0
})
</script>
<script>
$(".btnEditAkun").click(function(t) {
  t.preventDefault();
  var a = $(this).data("kode"),
    n = $(this).data("nama"),
    m = $(this).data("head"),
    o = $(this).data("dc"),
    r = $(this).attr("href");
  $("form.formDtaAkun").attr("action", r), $('form.formDtaAkun input[name="kode"]').val(a), $(
    'form.formDtaAkun input[name="kode"]').focus(), $('form.formDtaAkun input[name="nama"]').val(n), $(
    'form.formDtaAkun input[name="head"]').val(m), $('form.formDtaAkun select[name="dc"]').val(o), $(
    "form.formDtaAkun button.submit").html("update"), $("form.formDtaAkun button.submit").removeClass(
    "btn-danger"), $("form.formDtaAkun button.submit").addClass("btn-info")
})
</script>



</body>

</html>