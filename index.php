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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php 
            require_once "src/autoload.php";
            use Generator\JsonToClass;
            $jsonString = (isset($_POST['json'])?$_POST['json']:NULL);
        ?>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">PHP Class Generate</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Project in GitHub</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <form method="post" action="index.php">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="json">Enter JSON or URL to JSON</label>
                            <textarea id="json" name="json" class="form-control" ><?php echo $jsonString;  ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                        </div>
                    </div>

                </div>
            </form>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">PHP Class
                    <button type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-floppy-saved"></span> Save All
                    </button>
                        </h3>
                </div>
                <div class="panel-body">
                    <?php 
                        if (preg_match("/^http/", $jsonString))
                                $jsonString = file_get_contents($jsonString);
                        if ($jsonString) {
                            
                            $json = new JsonToClass();
                            $json->prepareJSONString($jsonString);
                            $json->startConvert();
                            foreach ($json->getClass()->getArrayFileClass() as $key => $value) {
                                
                            
                    ?>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="<?php echo "heading-$key";  ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo "collapse-$key";  ?>" aria-expanded="true" aria-controls="<?php echo "collapse-$key";  ?>">
                                        <?php echo "$key.php";  ?>
                                    </a>
                                    <button type="button" class="pull-right glyphicon glyphicon-floppy-saved"></button>
                                </h4>
                            </div>
                            <div id="<?php echo "collapse-$key";  ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo "heading-$key";  ?>">
                                <div class="panel-body">
                                    <pre>
                                    <?php
                                        echo str_replace('\n', '<br>', $value);
                                    ?>
                                    </pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>

    </body>
</html>
