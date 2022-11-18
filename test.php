<?php

$crypted = password_hash(1234, PASSWORD_ARGON2I);

var_dump($crypted);