<?php
	$data = json_decode(file_get_contents('data.json'), true);
	json_to_csv($data);


	function json_to_csv($data) {
		$filtered = [];

		foreach($data as $key => $val) {

			$filtered[] = array(
				"Name"  => $val['Name'],
				"Province" => $val['Province'],
				"City" 	=> $val['City'],
				"Postal Code"  => $val['Postal Code'],
				"Registration"	=> $val['Registration'],
				"Phone"	=> $val['Phone']
			);
		}

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="sample.csv"');
		$fp = fopen('php://output', 'wb');

		foreach($filtered as $line) {
		    fputcsv($fp, $line);
		}
		fclose($fp);
	}

	function phone_number($num) {
		$phone = implode(",", explode("Phone:", $num));
		$phone = ltrim($phone, ",");

		return $phone;
	}

	function address($address) {
		return preg_replace('!\s+!', ' ', trim(explode("Address:", $address)[1]));
	}

	function name($string, $start, $end) {
	    $string = ' ' . $string;
	    $ini 	= strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;

	    return substr($string, $ini, $len);
	}
?>