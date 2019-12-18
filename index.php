<?php
	ini_set("display_errors", 1);
	include('html_dom_parser.php');

	function ifExists($item) {
		return isset($item) ? strip_tags($item) : "N/A";
	}

	$resultSet = [];

	for ($i=1; $i <= 16; $i++) {

		$html = file_get_html("http://acupuncturealberta.ca/practitioners/?city=0&docname=0&zip_code=0&distance=100&ord=asc&page=$i");
		
		foreach($html->find('.table.table-bordered tbody') as $key => $val) {

			// if($key === 0) {
			// 	continue;
			// }
			foreach ($val->children as $k => $vaal) {

				$arr = explode("     ", $vaal->innertext);
				$arr = array_filter($arr);
				$arr = [
					'Name'  => ifExists($arr[2]),
					'Province'  => ifExists($arr[4]),
					'City'  => ifExists($arr[6]),
					'Postal Code'  => ifExists($arr[8]),
					'Registration'  => ifExists($arr[10]),
					'Phone'  => ifExists($arr[12]),
				];

				array_push($resultSet, $arr);

				// print_r($arr);
			}
		}

	}

	echo '<pre>';
	print_r($resultSet);
	$jsonResult = json_encode($resultSet);
	// return;
?>

<a id="downloadAnchorElem" style="display:none"></a>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
	// var data = [];
	// $('ul li').each(function() {
	//     var $this = $(this);

	//     data.push({
	//         'business name' : $this.find('h3').text(),
	//         'Phone' 		: $this.find('a.mobileOnlyLink').text(),
	//         'ClinicAddress' : $this.find('span.clinicAddress').text(),
	//         'emails'		: $this.find("a[href^='mailto:']").attr('href'),
	//         'name'			: $this.find('p').text()
	//     });
	// });
	
	var dataJson = '<?php echo $jsonResult ?>';
	console.log("json result:", dataJson);

	var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(dataJson);
	var dlAnchorElem = document.getElementById('downloadAnchorElem');
	dlAnchorElem.setAttribute("href", dataStr);
	dlAnchorElem.setAttribute("download", "scene.json");
	dlAnchorElem.click();
</script>
