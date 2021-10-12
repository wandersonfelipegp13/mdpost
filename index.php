<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Posts </title>
</head>

<body>
    <h1>Posts</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        ID: <input type="number" name="id"><br><br>
        <button type="submit" name="send"> Show </button>
    </form>
                    
</body>
</html>

<?php

require_once 'db_connect.php';
require __DIR__ . '/vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

session_start();

if(isset($_POST['send'])):
    $id = mysqli_escape_string($connect, $_POST['id']);
    
    if(!empty($id)):
        $sql = "SELECT txt FROM posts WHERE id = '$id'";

        $resultado = mysqli_query($connect, $sql);

        $dados = mysqli_fetch_array($resultado);
		
		///
		// Define your configuration, if needed
		$config = [];

		// Configure the Environment with all the CommonMark parsers/renderers
		$environment = new Environment($config);
		$environment->addExtension(new CommonMarkCoreExtension());

		// Add this extension
		$environment->addExtension(new TableExtension());

		// Instantiate the converter engine and start converting some Markdown!
		$converter = new MarkdownConverter($environment);

		echo $converter->convertToHtml($dados['txt']);
		
		///
		
    endif;
endif;

?>