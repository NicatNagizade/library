<?php
$string = "test (beetween) test (b2)";
$string = getBeetweens('(',')',$string);
print json_encode($string);