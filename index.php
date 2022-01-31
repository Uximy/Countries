<?php
    const countries = 'countries.txt';

    const dictionary = 'dictionary.txt';

    $country = $_POST['country'] ?? '';

    $result = '';

    $color = '';

    $fp = fopen(countries, 'a+');

    if (file_exists(dictionary)) {
        if (str_contains(file_get_contents(dictionary), $country)) {
            if ($country === '') {
                $result = '⚠️ Поле ввода пустой, заполни его названием страны. ⚠️';
                $color = '#FFAB00';
            }
            else{
                if (str_contains(file_get_contents(countries), $country)) {
                    $result = '❌ Такая запись уже есть в моём файле '. countries . ' ❌';
                    $color = '#FF1744';
                }else{
                    $result = '✔ Запись добавленна. ✔';
                    $color = '#00C853';
                    fputs($fp, $country ."\n");
                }
            }
        }
        else{
            $result = '❌ Такой странны нету в моём файле '. dictionary. ' ❌';
            $color = '#FF1744';
        }
    }else{
       fopen(dictionary, 'w+');
    }

    fclose($fp);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File</title>
</head>
<body>
    <form method="post">
        <label>Названия страны</label>
        <input name="country" type="text" placeholder="Названия страны">
        <br>
        <br>
        <input type="submit">
    </form>
    <br>
    <span style="color: <?=$color?>"><?= $result ?></span>
    <br>
    <br>
    <select>
        <?php
            $fp = file(countries, FILE_SKIP_EMPTY_LINES);

            foreach ($fp as $key => $data)  {
                echo "<option>$key. $data</option>";
            }
        ?> 
    </select>
</body>
</html>