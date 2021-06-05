<?php
require_once 'SecurityService.php';
$antiCSRF = new \Phppot\SecurityService\securityService();
$antiCSRF->insertHiddenToken();
?>