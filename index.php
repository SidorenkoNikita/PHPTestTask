<?php
	include_once("CProduct.php");
	$configs = include_once('config.php');
	$db_server = configs['server'];
	$db_user = configs["user"];
	$db_pass = configs["password"];
	$db_name = configs["db_name"];
	$conn;
	try{
            $conn = mysqli_connect( $db_server,
                                    $db_user,
                                    $db_pass,
                                    $db_name
            );
	}
	catch (mysqli_sql_exception){
		echo "Connection has not been establisted";
	}	
	$list = new CProducts();
	$list->getList(20, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ProductTable</title>
</head>
<body>	
	<table>
		<script type="text/javascript">
			$(document).ready(function(){
			$(".hiderow").click(function(){$(this).parents("tr").hide(); })
		});
		</script>
		<thead>
			<?php echo implode('</th><th>', array_keys($list)); ?>
		</thead>
		<tbody>
			<?php foreach ($list as $row): array_map('htmlentities', $row); ?><tr>
			    <td class="hiderow"><?php echo implode('</td><td>', $row); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</body>
