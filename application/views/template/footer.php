    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 0.0.1 <b>BETA</b>
      </div>
      <strong>Copyright &copy; 2019 - 2022 <a href="https://my.tfx.co.id">PT. Tifia Finansial Berjangka </a></strong> All rights
      reserved.
    </footer>

    </div>
    <!-- ./wrapper -->

    <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bower_components/PACE/pace.min.js'); ?>"></script>

    <!-- Morris.js charts -->
    <script src="<?= base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>

    <!-- SlimScroll -->
    <script src="<?= base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?= base_url('assets/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url('assets/bower_components/moment/min/moment.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?= base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>

    <script src="<?= base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>
    <script type="text/javascript">
      $('textarea.texteditor').ckeditor();
    </script>
    <script type="text/javascript">
      $(function() {
        CKEDITOR.config.extraPlugins = 'justify';
      });
    </script>

    <!-- AdminLTE App -->
    <!-- DataTables -->
    <script src="<?= base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bower_components/datatables/dataTables.checkboxes.js'); ?>"></script>
    <script src="<?= base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/jquery-nestable/jquery.nestable.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/alertify/alertify.js'); ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js'); ?>"></script>

    <!-- Select2 -->
    <script src="<?= base_url('assets/bower_components/bootstrap-select/js/bootstrap-select.js'); ?>"></script>
    <!-- menu funct -->
    <script src="<?= base_url('assets/dist/js/menu.js'); ?>"></script>
    <script src="<?= base_url('assets/statuskawin.js'); ?>"></script>
    <script src="<?= base_url('assets/komentar.js'); ?>"></script>
    <script src="<?= base_url('assets/komen.js'); ?>"></script>
    <script type="text/javascript">
      // To make Pace works on Ajax calls
      $(document).ajaxStart(function() {
        Pace.restart()
      });
      <?php
      if (isset($this->session->message)) { ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<a style="color:white"><?= $this->session->message; ?></a>');

      <?php } ?>
    </script>
    <?php (isset($code_js) ? $this->load->view($code_js) : ""); ?>
    <script type="text/javascript">
      $(document).ready(function() {
        // $.ajax({
        //   type: 'GET',
        //   url: '<?= base_url('adminarea/notifikasi/getTotalNotification') ?>',
        //   success: function(response, status, obj) {
        //     $('#notif-badge').html(response)
        //     response > 1 ? $('#notif-title').html('You have ' + response + ' notifications') : $('#notif-title').html('You have ' + response + ' notification')
        //   }
        // })
        // $.ajax({
        //   type: 'GET',
        //   url: '<?= base_url('adminarea/notifikasi/getcountall') ?>',
        //   success: function(response, status, jqXHR) {
        //     $('#deposit-badge').html(response)
        //     response > 1 ? $('#deposit-title').html('You have ' + response + ' notifications') : $('#deposit-title').html('You have ' + response + ' notification')
        //   }
        // })
        // $.ajax({
        //   type: 'GET',
        //   url: '<?= base_url('adminarea/notifikasi/getAllNotif') ?>',
        //   success: function(response, status, jqXHR) {
        //     $('#notif-all').append(
        //       '<li>' +
        //       '<a href="">' +
        //       '<i class="fa fa-users text-success"></i> ' + response.register + ' new members <strong>register</strong> ' +
        //       '</a>' +
        //       '</li>' +
        //       '<li>' +
        //       '<a href="">' +
        //       '<i class="fa fa-users text-success"></i> ' + response.email + ' user unverify email' +
        //       '</a>' +
        //       '</li>' +
        //       '<li>' +
        //       '<a href="">' +
        //       '<i class="fa fa-users text-aqua"></i> ' + response.complete + ' new members <strong>completed register</strong>' +
        //       '</a>' +
        //       '</li>'
        //     );
        //   },
        //   error: function(jqXHR, status, response) {
        //     console.log(error)
        //     alert('Error occured. Please try again later.')
        //   }
        // })
        // $.ajax({
        //   type: 'GET',
        //   url: '<?= base_url('adminarea/notifikasi/getalldata') ?>',
        //   success: function(response, status, jqXHR) {
        //     // response.forEach(loopall);
        //     for (let index = 0; index < response.length; index++) {
        //       var element = response[index];
        //       var imgurl = '<?= base_url() . "uploads/photo/" ?>' + element.foto_terkini;
        //       // var imgname = element.foto_terkini;
        //       // var url = imgurl+imgname;
        //       $('#deposit-all').append(
        //         '<li>' +
        //         '<a href="#">' +
        //         '<div class="pull-left">' +
        //         '<img src="' + imgurl + '" class="img-circle" alt="User Image)">' +
        //         '</div>' +
        //         '<h4>' +
        //         element.nama_lengkap +
        //         '<small><i class="fa fa-clock-o"></i>' + element.tanggal + ' </small>' +
        //         '</h4>' +
        //         '<p>' + element.aktifitas + '</p>' +
        //         '</a>' +
        //         '</li>'
        //       );
        //     }
        //   },
        //   error: function(jqXHR, status, response) {
        //     console.log(error)
        //     alert('Error occured. Please try again later.')
        //   }
        // })

        function loopall(item, index) {
          console.log(item + ' at index: ' + index)
        }
        $('#deposit-read').click(function() {
          $.ajax({
            type: 'POST',
            url: '<?= base_url('adminarea/notifikasi/readall') ?>',
            success: function(response, status, jqXHR) {
              window.location.reload(true)
            },
            error: function(jqXHR, status, response) {
              console.log(error)
              alert('Error occured. Please try again later.')
            }
          })
        });
      });
    </script>
    </body>

    </html>