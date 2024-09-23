      </div>
      <!-- /.box-body -->
      </div>
      <!-- /.box -->
      </div>
      </div>


      </section>
      <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <div id="toast" class="toast">
        This is a toast message.
      </div>
      <script>
        function toast(message) {
          $("#toast").html(message).fadeIn().delay(3000).fadeOut();
        };
      </script>

      <div id="loading">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span> <!-- Screen reader text -->
      </div>
      <script>
      function loadingshow(){
        $("#loading").show();
      }
      function loadinghide(){
        $("#loading").hide();
      }
      </script>
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          PT. SHINSUNG GRAND INDONESIA | <a href="">VERSION 1.0.1</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">IT Dept PT SGI</a>.</strong> All rights reserved.
      </footer>

      </div>
      <!-- ./wrapper -->
      <script src="<?php echo base_url() . 'assets/js/custom.js' ?>"></script>
      </body>

      </html>