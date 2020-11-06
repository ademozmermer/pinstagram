<?php

use AdemOzmermer\Auth\Auth;

$auth = new \AdemOzmermer\Auth\Auth('username', 'password');

print_r($auth->login());
