<!DOCTYPE html> 
<html> 
<head> 
	<title></title>
	<style>

	div form {
		width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}

	div form * {
		margin: 0.5rem 0;
	}

	div form label {
		font-size: 1.2rem;
		margin-bottom: 0;
	}

	</style>
</head>
<body>
<div style="position:left;margin:0px;">
        <div style="opacity:1;position:absolute;left:0px;top:-30px;width:100%;height:140px;background-color:#2B2D42">
        
	<center><img src="https://www.cotiss.com/hubfs/Fill%2013.svg" alt="Cotiss" style="margin-top:2.5rem;position:relative;left:-10px;">
	<h1 style="color:#05ca86;font-size:4rem;margin-top:-0.5rem;font-family:sans-serif;">Honest Feedback</h1>
	</center>
</div>


<div style="margin:10rem auto;width:20%;margin-top:10rem;">
	<form action="writeData.php" method="post"> 
  		<textarea style="height:10rem;font-family:sans-serif;" placeholder="insert your feedback here" name="message"></textarea>
   		<br>
    		<button style="margin:3px;height:3rem;background-color:#05ca86;border:1px solid #05ca86;border-radius:4px;color:white;font-size:2rem;cursor:pointer;" type="submit" name="submit">Submit</button>
	</form>
</div>
<?php
  require 'vendor/autoload.php';

  use Aws\DynamoDb\DynamoDbClient;

  $client = DynamoDbClient::factory(array(
    'region' => 'us-east-1',
    'version' => 'latest'
  ));

  $tableName = 'Cotiss-Honest-Feedback-DB';

  $response = $client->scan(array(
    'TableName' => $tableName
  ));

  $items = $response->get('Items');
  
  $feedback = $items[array_rand($items)];

  echo '<p>' . $feedback['message']['S'] . '</p>';
?>
</body>
</html>