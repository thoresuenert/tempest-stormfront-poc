<?php

use Tempest\Http\Session\Session;

use function Tempest\Http\csrf_token;

$name = Session::CSRF_TOKEN_KEY;
$value = csrf_token();
?>

<meta name="csrf_name" :content="$name">
<meta name="csrf_token" :content="$value">
