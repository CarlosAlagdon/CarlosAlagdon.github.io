<?php
 
	require_once '../bom/connect.php';
	require_once '../dao/IselcoData.php';
	$IselcoData = new IselcoData();
	session_start();
class Export 
{	
	//generateDailyTrue


	public function generateTimeTrue($summary,$area) { 
		$array = array();
		$prev ="";


		 $day1 = date_format($summary[0], "M d, Y");
		for ($i=0; $i < count($summary); $i++) {


			$arrayone = array(); 
			$mwciData = new MWCIData();
			 //var_dump($summary[$i]);
			 $arrayone["DATE"] = date_format($summary[$i][0], "M d, Y")." ".date_format($summary[$i][3], "h:i A");//
			 $arrayone["FLOW"] = $summary[$i][4]." ".$summary[$i][5];
			
			$arrayone["prev"] = $prev;

			if($prev == "") {
				$currentTime = date_format($summary[$i][3], "h:i A");
				$timeDate = date_format($summary[$i][0], "Y-m-d");
				$prevTime = $mwciData->prevTime($area, $timeDate, $currentTime);
				$arrayone["prev"] = number_format($prevTime[0][6],2, '.', ',');
			}

			$arrayone["current"]  = number_format($summary[$i][6],2, '.', ',')." ".$summary[$i][9];
			$prev = 	$arrayone["current"] ;

				$cur = $arrayone['current'];
 				$prev1 = $arrayone['prev'];
 				$cur = str_replace(",", "", $cur);
 				$prev1 = str_replace(",", "", $prev1);
 				$total = floatval($cur) - floatval($prev1);
 				$arrayone['total'] =  number_format($total,2, '.', ',') ; 


			$arrayone["battery"] = $summary[$i][12]."%";
			$arrayone["min"] = $summary[$i][10];
			$arrayone["max"] = $summary[$i][11];
			$arrayone["alarm"] = number_format($summary[$i][13],2, '.', ',');

					   
   						 //4 flowratte
					    //5 flow unit
					    //6 current
					    //9 current unit
					    //8 

					    //13 alarm
					    //12 battery
					    // $prevTime = $mwciData->prevTime($_POST['location'], $timeDate, $currentTime);


			array_push($array, $arrayone);
		}


		return $array;

	}

	public function generateSummary($date, $serial, $records, $report, $feeder) {
		// echo count($records);
		// echo date_format(date_create($records[0]), "H:i:s");
		// for ($i=0; $i < count($records); $i++) { 
		// 	$arrayone = array();
		// 	$IselcoData = new IselcoData();
		// 	echo $value = $records[$i];
		// 	echo $records[0];
		// 	var_dump($records);
		// 	$selectTotalizerData = $IselcoData->selectTotalizerData($date, $serial, $value, $report, "Anupul69");
		// 	$selectTotalizerData1 = $IselcoData->selectTotalizerData($date, $serial, $value, $report, "AnupulTl");
			
		// 	echo "<script>alert('I am trying to edit and debug');<script>";
		// 	echo $arrayone["TIME"] = $value;
		// 	echo $arrayone["TAP POS"] = $selectTotalizerData[0][17];
		// 	$arrayone["OIL TEMP"] = $selectTotalizerData[0][18];
		// 	$arrayone["OIL LEVEL"] = $selectTotalizerData[0][19];
		// 	$arrayone["PRI WNDG"] = $selectTotalizerData[0][20];
		// 	$arrayone["SEC WNDG"] = $selectTotalizerData[0][21];
		// 	var_dump($arrayone);
		// }
	}


	public function style(){
		return array(
            'borders' => array(
              'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_HAIR,
                    'color' => array(
                        'rgb' => '808080'
                    )
              )
            ),
            'alignment' => array(
                'horizontal' =>   PHPExcel_Style_Alignment::HORIZONTAL_CENTER  ,  
                'indent' => 2
            ),
            'font' => array(
                'size' => 9
            )
      );
	}
}
