<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo "\nDatabase error: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";
	?>
    
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>

<script type="text/javascript">
$(document).ready(function() {
  setInterval(function() {
    cache_clear()
  }, 5000);
});

function cache_clear() {
  window.location.reload(true);
  console.log('refresh');
  // window.location.reload(); use this if you do not remove cache
}
</script>