<?php
session_start ();
//session_write_close();

require 'vendor/autoload.php';

// Database information
$settings = array (
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'port' => '3306',
		'database' => 'survey',
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => ''
);

// Bootstrap Eloquent ORM

$container = new Illuminate\Container\Container ();
$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory ( $container );
$conn = $connFactory->make ( $settings );
$resolver = new \Illuminate\Database\ConnectionResolver ();
$resolver->addConnection ( 'default', $conn );
$resolver->setDefaultConnection ( 'default' );
\Illuminate\Database\Eloquent\Model::setConnectionResolver ( $resolver );


class Fragrance extends \Illuminate\Database\Eloquent\Model {
	protected $table = 'fragrance';
	protected $fillable = array (
			'term'
	);
}

class Rating extends \Illuminate\Database\Eloquent\Model {
	protected $table = 'ratings';
	protected $fillable = array (
  			'uid',
  			'term',
  			'score'
	);
}


$app->post ( '/add/term', function () use($app) {
	// curl -i -d "text=perfume" http://localhost/scent/api/v1/add/term
	
	$paramText = $app->request->post ( 'text' );
	//$paramText = filter_var ( $paramText, FILTER_SANITIZE_STRING );
	
	try {
		// Or create a new book
		$frag = new \Fragrance ( array (
				'term' => $paramText 
		) );
		
		$frag->save ();
	} catch ( Exception $e ) {
		$response->write ( '{"error":{"text":' . 'Unable to get the web service. ' . $e->getMessage () . '}}' );
	}
} );



$app->post ( '/add/rating', function () use($app) {
	// curl -i -d "uid=1&score=3&text=kenneth" http://localhost/scent/api/v1/add/rating
	
	$paramText = $app->request->post ( 'text' );
	$paramScore = $app->request->post ( 'score' );


	$uid = $_SESSION['uid'];



	try {
		// Or create a new book
		$rating = new \Rating ( array (
				'uid' => $uid,
				'term' => $paramText,
				'score' => intval ($paramScore)
		) );
		
		$rating->save ();

	} catch ( Exception $e ) {
		echo '{"error":{"text":' . 'Unable to get the web service. ' . $e->getMessage () . '}}';
	}

	

} );


$app->get ( '/data', function () {
	
	// Fetch all todo lists
	$html = "";
	$vuid = $_SESSION['uid'];
	#$vuid = 1;
	try {

		$rating = \Rating::where ( 'uid', $vuid )->get();
		$vData = $rating->toArray();

		$html = $html . "<thead>
						<tr>
						<th>Fragrance</th>
						<th>Strongly Disagree</th>
						<th>Disagree</th>
						<th>Neutral</th>
						<th>Agree</th>
						<th>Strongly Agree</th>
						</tr>
						</thead> <tbody>";
		
		$countElem = count ($vData);
		
		if ($countElem > 1)
		{
			for ($ind = 0; $ind < $countElem; $ind++) {
				$currentData = $vData[$ind];
			
					
				$uid = $currentData["uid"];
				$term = urldecode($currentData["term"]);
				$score = $currentData["score"];
					
				$id0 = $term."_0";
				$id1 = $term."_1";
				$id2 = $term."_2";
				$id3 = $term."_3";
				$id4 = $term."_4";
					
				if ($score == 0)
				{
					$html = $html . "<tr>
					<td>$term </td>;
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id0\" checked/> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id1\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id2\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id3\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id4\" /> </td>
					</tr>";
			
			
				} elseif ($score == 1)
				{
					$html = $html . "<tr>
					<td>$term </td>;
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id0\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id1\" checked/> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id2\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id3\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id4\" /> </td>
					</tr>";
			
				} elseif ($score == 2)
				{
					$html = $html . "<tr>
					<td>$term </td>;
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id0\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id1\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id2\" checked/> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id3\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id4\" /> </td>
					</tr>";
			
				}
				elseif ($score == 3)
				{
					$html = $html . "<tr>
					<td>$term </td>;
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id0\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id1\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id2\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id3\" checked/> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id4\" /> </td>
					</tr>";
			
				}
				else
				{
					$html = $html . "<tr>
					<td>$term </td>;
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id0\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id1\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id2\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id3\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id4\" checked/> </td>
					</tr>";
			
				}
					
			}			
		}
		else 
		{
			//new users
			
			try {
				$frag = \Fragrance::all ();
				$vData = $frag->toArray();
				
				$countElem = count ($vData);
				for ($ind = 0; $ind < $countElem; $ind++) {
					$currentData = $vData[$ind];

					$term = urldecode($currentData["term"]);
						
					$id0 = $term."_0";
					$id1 = $term."_1";
					$id2 = $term."_2";
					$id3 = $term."_3";
					$id4 = $term."_4";
					
					$html = $html . "<tr>
					<td>$term </td>;
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id0\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id1\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id2\" checked/> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id3\" /> </td>
					<td><input type=\"radio\" name=\"$term\" class=\"frClass\" id=\"$id4\" /> </td>
					</tr>";
					
				}			

			} catch ( Exception $e ) {
				echo '{"error":{"text":' . 'Unable to get the web service. ' . $e->getMessage () . '}}';
			}
		}
		
		$html = $html . "</tbody>";

		echo $html;
	} catch ( Exception $e ) {
		echo '{"error":{"text":' . 'Unable to get the web service. ' . $e->getMessage () . '}}';
	}
} );






