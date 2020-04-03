<?php
	$data = json_decode(file_get_contents('output2.json'), true);
	
	json_to_csv($data);

	

	function json_to_csv($data) {

		$filtered = [];

		foreach($data as $key => $val) {


			$filtered[] = array(
				"Full Name"  => isset($val['Full Name']) ? $val['Full Name'] : "N/A",
				"Title/Type" => isset($val['Title/Type']) ? $val['Title/Type'] : "N/A",
				"Status" 	=> isset($val['Status']) ? $val['Status'] : "N/A",
				"Registration ID"  => isset($val['Registration ID']) ? $val['Registration ID'] : "N/A",
				"Phone"	=> isset($val['Phone']) ? $val['Phone'] : "N/A",
				"Email"	=> isset($val['Email']) ? $val['Email'] : "N/A",
				"Address"	=> isset($val['Address']) ? $val['Address'] : "N/A",
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