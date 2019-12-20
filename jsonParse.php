<?php
	$data = json_decode(file_get_contents('data.json'), true);
	
	json_to_csv($data);

	

	function json_to_csv($data) {


		function ifExists($item) {
			return isset($item) ? $item : "N/A";
		}
		$filtered = [];

		foreach($data as $key => $val) {

			// echo "<pre>";
			// print_r($val);

			$filtered[] = array(
				"First Name"  => isset($val['First Name']) ? $val['First Name'] : "N/A",
				"Surname" => isset($val['Surname']) ? $val['Surname'] : "N/A",
				"Email" 	=> isset($val['Email']) ? $val['Email'] : "N/A",
				"Web Site"  => isset($val['Web Site']) ? $val['Web Site'] : "N/A",
				"Mobile"	=> isset($val['Mobile']) ? $val['Mobile'] : "N/A",
				"Practice Name"	=> isset($val['Practice Name']) ? $val['Practice Name'] : "N/A",
				"Suburb"	=> isset($val['Suburb']) ? $val['Suburb'] : "N/A",
				"City"	=> isset($val['City']) ? $val['City'] : "N/A",
				"Therapies Offered"	=> isset($val['Therapies Offered']) ? $val['Therapies Offered'] : "N/A",
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

?>