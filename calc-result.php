<?php
session_start();

if (!empty($_SESSION['lastExpression'])) {
    echo "Последние вычисления: " . $_SESSION['lastExpression'];
}

?>
