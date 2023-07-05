<?php
require_once __DIR__ . '/../../source/autoload.php';

use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Helper;


?>

</div>
</div>
</div>
</div>
</section>
<!-- Intro Section -->

</header>
<!-- Main Navigation -->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/js/mdb.js"></script>

<!-- Custom scripts -->
<script>

// Material Select Initialization
$(document).ready(function () {
  $('.mdb-select').material_select();
  <?php Session::toastMessages(); ?>
});

</script>

</body>

</html>
