<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once "src/autoload.php";

        use Generator\JsonToClass;

        $jsonStr = file_get_contents("http://api.openweathermap.org/data/2.5/forecast/city?id=3448439&APPID=180fe3cd9e5ec41da59b06a0260c3f62");
        $json = new JsonToClass();
        $json->prepareJSONString($jsonStr);
        $json->startConvert();
//        print_r($json->getClass()->getArrayFileClass());
        foreach ($json->getClass()->getArrayFileClass() as $key => $value) {
//                $fp = fopen("C:\\class\\".$key.".php", "a");
//                $escreve = fwrite($fp, $value);
//                fclose($fp);
            ?>
        <div style="width: 800px; height: 800px; border: solid 1px black; overflow-y: scroll;">
            <pre>
            <?php echo str_replace('\n','<br>',$value); ?>
            </pre>
        </div>
        <br>
            <?php
        }
        ?>

    </body>
</html>
