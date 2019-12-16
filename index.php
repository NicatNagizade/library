<?php

use App\Models\User;
use Lara\App\Models\DB;

require_once __DIR__.'/config/app.php';
$user = User::find(1);
print_r($user);