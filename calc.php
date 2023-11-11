<?php

$connection = mysqli_connect('localhost', 'root', '', 'calc');

if (!$connection) {
    die('Связь не установлена' . mysqli_connect_error()) ;
}

$calculate = '';

if (isset($_REQUEST['valueX'])) {
    $x = $_REQUEST['valueX'];
}

 if (isset($_REQUEST['valueY'])) {
     $y = $_REQUEST['valueY'];
 }

 if (isset($_REQUEST['selectOption'])) {
     $operation = $_REQUEST['selectOption'];
 }


     if (!empty($x) && !empty($y)) {

         if ($operation == "+") {
             $calculate = $x + $y;
         } elseif ($operation == "-") {
             $calculate = $x - $y;
         } elseif ($operation == "*") {
             $calculate = $x * $y;
         } elseif ($operation == ":") {
             if ($y != 0) {
                 $calculate = $x / $y;
             } else {
                 $error = "Деление на ноль невозможно";
             }
         }
         mysqli_query(   $connection, "INSERT INTO results (operand_1, `operation`, operand_2, resault, `result_expression`) VALUES (" . $x . ", '" . $operation . "', " . $y . ", " . $calculate . ", '" . $x . $operation . $y . "=" . $calculate . "');"   );

     }


if (!empty($_REQUEST["calcButton"]) && (empty($_REQUEST["valueX"]) || empty($_REQUEST["valueY"])) ) {
    $error = "Введите все  необходимые значения";
}

$query = mysqli_query($connection, "SELECT * FROM	`results` ORDER BY `id` DESC LIMIT 7");

$resultList =[];

while ($resultRow = mysqli_fetch_assoc($query)) {
    $resultList[] = $resultRow;
}
//echo '<pre>';
//print_r($resultList);
//echo '</pre>';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="POST">

        <div>
            <label> <input type="text" name="valueX"> </label>
        </div>

        <div>
            <label>
                <select id="selOption" name="selectOption">
                    <option value="+">Сложение (+)</option>
                    <option value="-">Вычитание (-)</option>
                    <option value="*">Умножение (*)</option>
                    <option value=":">Деление (/)</option>
                </select>
            </label>
        </div>

        <div>
            <label><input type="text" name="valueY"></label>
        </div>

        <div>
            <input type="submit" value="Вычислить" name="calcButton" onclick="">
        </div>

    </form>

    <?php if (!empty($error)) { ?>
        <div>
            <span>Ошибка: </span>
            <span>
                <?php
                echo $error;
                ?>
            </span>
        </div>
    <?php } ?>

    <?php if (!empty($calculate)) { ?>
        <div>
            <span>Результат: </span>
            <span>
                <?php
                echo $calculate;
                ?>
            </span>
        </div>

    <?php } ?>

        <div>
            <span>Последние результаты: </span>
            <span>
                <?php foreach ($resultList as $result) {?>
        <span>
           <hr> [<?php echo $result['created_at']; ?>]
        </span>
           <span>  <?php echo $result['result_expression']?>
                <?php }?></span>
        </div>

</body>
</html>