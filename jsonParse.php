<?php
	$data = json_decode(file_get_contents('data.json'), true);
	json_to_csv($data);


	function json_to_csv($data) {
		$filtered = [];

		foreach($data as $key => $val) {
			$Practitioner = trim(name($val['name'], "Practitioner:", "- Email"));
			$Address 	  = address($val['ClinicAddress']);
			$Phone 		  = phone_number($val['Phone']);
			$bname 		  = trim($val['business name']);
			$emails 	  = trim(explode("mailto:", $val['emails'])[1]);

			$filtered[] = array(
				"Email"			=> $emails,
				"BusinessTitle" => $bname,
				"Phone" 		=> $Phone,
				"Address" 		=> $Address,
				"Practitioner"	=> $Practitioner
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