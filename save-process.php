<?php

require __DIR__ . '/vendor/autoload.php';

if (!empty($_POST)) {
    // process the form details here
}

// This part of the code will redirect back the user to the "main page". Status Code 301 means a permanent redirect
header('Location: index.php', true, 301);
exit();
