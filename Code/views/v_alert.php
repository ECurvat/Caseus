<?php

if(isset($alert))
{
	if ($alert['messageAlert'] == SUCCES_OPERATION) {
		?>
		<div class="u-full-width msg-success"><i class="fa-solid fa-check"></i>    <?= $alert['messageAlert'] ?></div>
		<?php
	} else {
		?>
		<div class="u-full-width msg-danger"><i class="fa fa-times-circle"></i>    <?= $alert['messageAlert'] ?></div>
		<?php
	}

}
