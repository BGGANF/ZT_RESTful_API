<?php
/* Init the rights. */
$config->rights = new stdclass();

/* For guest users. */

/*用户*/
$config->rights->guest['user']['login']         = 'login';
$config->rights->guest['user']['register']      = 'register';
$config->rights->guest['user']['getbyid']       = 'getbyid';



