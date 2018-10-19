
<?php 
require_once '..\bom\connect.php';

class FeederData {

	public function selectLocationNames(){
     $connect = new Connect();

      $query = "SELECT DISTINCT location_name, location_id
              FROM [".$connect->db_name."].[dbo].[tbl_location]
              ORDER BY location_name";
              
     $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["location_id"], $fetch["location_name"]);
        array_push($list, $records);
        }
        $connect->Close();
        return $list;
    }	

	public function getStartAndEndDate($date) {
		$week = substr($date, 6,2);
		$year = substr($date,0,4);
	  	$dto = new DateTime();
	  	$ret['week_start'] = $dto->setISODate($year, $week)->format('Y-m-d');
	  	$ret['week_end'] = $dto->modify('+6 days')->format('Y-m-d');
	  	return $ret;
	}

	public function getFeederDataVa($feederName, $date){
		$connect = new Connect();

		$query = "	
					SELECT TOP 1 va, convert(varchar(11), time, 114)  as vatime
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE date = '".$date."'	
					ORDER BY va DESC
				";
		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["va"], $fetch["vatime"]);
        	array_push($list, $records);
        }
        $connect->Close();
        return $list;

	}


	public function getFeederDataVb($feederName, $date){
		$connect = new Connect();

		$query = "	
					SELECT TOP 1 vb, convert(varchar(11), time, 114)  as vbtime
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE date = '".$date."'		
					ORDER BY vb DESC
				";
		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["vb"], $fetch["vbtime"]);
        	array_push($list, $records);
        }
        $connect->Close();
        return $list;

	}

	public function getFeederDataVc($feederName, $date){
		$connect = new Connect();

		$query = "	
					SELECT TOP 1 vc, convert(varchar(11), time, 114)  as vctime
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE date = '".$date."'	
					ORDER BY vc DESC
				";
		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["vc"], $fetch["vctime"]);
        	array_push($list, $records);
        }
        $connect->Close();
        return $list;

	}

	public function getFeederDataVaMin($feederName, $date){
		$connect = new Connect();

		$query = "	
					SELECT TOP 1 va, convert(varchar(11), time, 114)  as vatime
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE date = '".$date."'	
					ORDER BY va ASC
				";
		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["va"], $fetch["vatime"]);
        	array_push($list, $records);
        }
        $connect->Close();
        return $list;

	}


	public function getFeederDataVbMin($feederName, $date){
		$connect = new Connect();

		$query = "	
					SELECT TOP 1 vb, convert(varchar(11), time, 114)  as vbtime
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE date = '".$date."'		
					ORDER BY vb ASC
				";
		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["vb"], $fetch["vbtime"]);
        	array_push($list, $records);
        }
        $connect->Close();
        return $list;

	}

	public function getFeederDataVcMin($feederName, $date){
		$connect = new Connect();

		$query = "	
					SELECT TOP 1 vc, convert(varchar(11), time, 114)  as vctime
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE date = '".$date."'	
					ORDER BY vc ASC
				";
		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["vc"], $fetch["vctime"]);
        	array_push($list, $records);
        }
        $connect->Close();
        return $list;

	}

	public function getFeederDataDemand($feederName, $date){
		$connect = new Connect();

		
		/*$query = "	

				SELECT TOP 1 kwt.kwa + kwt.kwb + kwt.kwc as Kwtotal, convert(varchar(11), kwt.time, 114)  as kwtime
				FROM
				(
				SELECT va * ia * 0.90 as kwa,  vb * ib * 0.90 as kwb, vc * ic * 0.90 as kwc, time
				FROM [".$connect->db_name."].[dbo].[".$feederName."]
				WHERE date = '".$date."'
				)kwt
				ORDER by Kwtotal DESC

				";*/

				$query = "	

				SELECT TOP 1 kwt.kwa + kwt.kwb + kwt.kwc as Kwtotal, convert(varchar(11), kwt.time, 114)  as kwtime
				FROM
				(
				SELECT va * ia * pftotal as kwa,  vb * ib *pftotal as kwb, vc * ic * pftotal as kwc, time
				FROM [".$connect->db_name."].[dbo].[".$feederName."]
				WHERE date = '".$date."'
				)kwt
				ORDER by Kwtotal DESC

				";

				$list = array();
				$db = $connect->Open();
		        $result = sqlsrv_query($db, $query);
		        while ($fetch = sqlsrv_fetch_array($result)) {
		            $records = array($fetch["Kwtotal"], $fetch["kwtime"]);
		        	array_push($list, $records);
				}

        $connect->Close();
        return $list;

	}

	public function getFeederDataDemandMonthly($feederName, $date){
		$connect = new Connect();


		if ($date == "January") {
			$month = '1';
	    }elseif ($date == "February") {
	    	$month = '2';
	    }elseif ($date == "March") {
	    	$month = '3';
	    }elseif ($date == "April") {
	    	$month = '4';
	    }elseif ($date == "May") {
	    	$month = '5';
	    }elseif ($date == "June") {
	    	$month = '6';
	    }elseif ($date == "July") {
	    	$month = '7';
	    }elseif ($date == "August") {
	    	$month = '8';
	    }elseif ($date == "September") {
	    	$month = '9';
	    }elseif ($date == "October") {
	    	$month = '10';
	    }elseif ($date == "November") {
	    	$month = '11';
	    }elseif ($date == "December") {
	    	$month = '12';
	    }

			$query = "
					
					SELECT DISTINCT date as time, MAX(yy.time)  as kwtime, yy.Kwtotal as maxkwtotal
					FROM 
					(
					SELECT (va * ia * pftotal) +  (vb * ib * pftotal) + (vc * ic * pftotal) as Kwtotal , date, time
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE MONTH(date) = '".$month."'
					) yy
					JOIN
					(
					SELECT MAX(kwt.kwa + kwt.kwb + kwt.kwc) as maxkwtotal, date  as kwtime
					FROM
					(
					SELECT va * ia * pftotal as kwa,  vb * ib * pftotal as kwb, vc * ic * pftotal as kwc, date, time
					FROM [".$connect->db_name."].[dbo].[".$feederName."]
					WHERE MONTH(date) = '".$month."'
					)kwt
					GROUP by date
					--ORDER by kwtime
					)tt
					ON tt.maxkwtotal = yy.Kwtotal AND tt.kwtime = yy.date
					GROUP BY yy.Kwtotal, yy.date
					ORDER BY  yy.date
			";

					$list = array();
					$db = $connect->Open();
			        $result = sqlsrv_query($db, $query);
			        while ($fetch = sqlsrv_fetch_array($result)) {
			            $records = array($fetch["kwtime"], $fetch["maxkwtotal"], $fetch["time"]);
			        	array_push($list, $records);
			        }

		
			

        $connect->Close();
        return $list;

	}

	public function getAlarms($date){
		$connect = new Connect();

		$query = "
					SELECT FORMAT(CAST(Date_Time as datetime) , 'MM/dd/yyyy HH:mm:ss') as Time
					      ,Alarm_Point_Name
					      ,State
					      ,Comment
					  FROM [".$connect->db_name."].[dbo].[Alarm_Log]
					  WHERE CONVERT(DATETIME, FLOOR(CONVERT(FLOAT, Date_Time))) = '".$date."' 
					ORDER BY 1

		";

		$list = array();
		$db = $connect->Open();
        $result = sqlsrv_query($db, $query);

		while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["Time"], $fetch["Alarm_Point_Name"], $fetch["State"], $fetch["Comment"]);
        	array_push($list, $records);
        }

        $connect->Close();
        return $list;
	}

	public function getReport($date){
		$connect = new Connect();

		if ($date == "January") {
			$month = '1';
	    }elseif ($date == "February") {
	    	$month = '2';
	    }elseif ($date == "March") {
	    	$month = '3';
	    }elseif ($date == "April") {
	    	$month = '4';
	    }elseif ($date == "May") {
	    	$month = '5';
	    }elseif ($date == "June") {
	    	$month = '6';
	    }elseif ($date == "July") {
	    	$month = '7';
	    }elseif ($date == "August") {
	    	$month = '8';
	    }elseif ($date == "September") {
	    	$month = '9';
	    }elseif ($date == "October") {
	    	$month = '10';
	    }elseif ($date == "November") {
	    	$month = '11';
	    }elseif ($date == "December") {
	    	$month = '12';
	    }

/*		$query = "
			SELECT res.Alarm_Point_Name [Alarm_Point_Name], FORMAT(CAST(res.Start_Time as datetime) , 'MM/dd/yyyy HH:mm:ss') [Start_Time], FORMAT(CAST(res.[End_Time] as datetime) , 'MM/dd/yyyy HH:mm:ss') [End_Time],
				  DATEDIFF(SECOND,res.Start_Time,res.End_Time) [Duration]
				  FROM (
				  SELECT Alarm_Point_Name, State as [state], Alarm_Point_Value,Comment,
							LEAD(Date_Time, 1, NULL) OVER (PARTITION BY Alarm_Point_Name ORDER BY Date_Time DESC) [Start_Time],
							Date_Time as End_Time
					FROM [".$connect->db_name."].[dbo].[Alarm_Log]
					WHERE MONTH(Date_Time) = '".$month."'
					AND (Comment = 'Trip'
					OR Comment = 'Close')
					--ORDER BY Date_Time
				  )res
				  WHERE FORMAT(CAST(res.Start_Time as datetime) , 'MM/dd/yyyy HH:mm:ss') IS NOT NULL
				  AND res.[state] = 'Normal'
				  ORDER BY 3
		";*/

		$query = "

				SELECT res.Alarm_Point_Name [Alarm_Point_Name], CONVERT(varchar(25), res.Start_Time, 120) [Start_Time], CONVERT(varchar(25), res.End_Time, 120) [End_Time],
				  DATEDIFF(SECOND,res.Start_Time,res.End_Time) [Duration]
				  FROM (
				  SELECT Alarm_Point_Name, State as [state], Alarm_Point_Value,Comment,
							LEAD(Date_Time, 1, NULL) OVER (PARTITION BY Alarm_Point_Name ORDER BY Date_Time DESC) [Start_Time],
							Date_Time as End_Time
					FROM [".$connect->db_name."].[dbo].[Alarm_Log]
					WHERE MONTH(Date_Time) = '".$month."'
					AND (Comment = 'Trip'
					OR Comment = 'Close')
				  )res
				  WHERE CONVERT(varchar(25), res.Start_Time, 120) IS NOT NULL
				  AND res.[state] = 'Normal'
				  ORDER BY 3
		";

		

        $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);

		while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["Alarm_Point_Name"], $fetch["Start_Time"], $fetch["End_Time"], $fetch["Duration"]);
        	array_push($list, $records);
        }
		
		$connect->Close();
        return $list;

	}

	public function getTripDemand($feederName,$tripTime){
		$connect = new Connect();

		if ($feederName == "Batal_Feeder_1_Breaker_Status") {
			$feeder = "Batal_Feeder_1";
			$fname = "Batal";
		}elseif ($feederName == "Batal_Feeder_2_Breaker_Status") {
			$feeder = "Batal_Feeder_2";
			$fname = "Batal";
		}elseif ($feederName == "Batal_Feeder_3_Breaker_Status") {
			$feeder = "Batal_Feeder_3";
			$fname = "Batal";
		}elseif ($feederName == "Batal_Feeder_4_Breaker_Status") {
			$feeder = "Batal_Feeder_4";
			$fname = "Batal";
		}elseif ($feederName == "Batal_SF6_Breaker_Status") {
			$feeder = "Batal_Totalizer";
			$fname = "Batal";
		}elseif ($feederName == "Cordon_Feeder_1_Breaker_Status") {
			$feeder = "Cordon_Feeder_1";
			$fname = "Cordon";
		}elseif ($feederName == "Cordon_Feeder_2_Breaker_Status") {
			$feeder = "Cordon_Feeder_2";
			$fname = "Cordon";
		}elseif ($feederName == "Cordon_Feeder_3_Breaker_Status") {
			$feeder = "Cordon_Feeder_3";
			$fname = "Cordon";
		}elseif ($feederName == "Cordon_Feeder_4_Breaker_Status") {
			$feeder = "Cordon_Feeder_4";
			$fname = "Cordon";
		}elseif ($feederName == "Cordon_Main_Breaker_Status") {
			$feeder = "Cordon_Totalizer";
			$fname = "Cordon";
		}

		$tripTimeDate = substr($tripTime,0,10);

		if ($fname == "Batal") {
			$query = "
				SELECT time, Kwtotal, FORMAT( time, 'HH:mm:ss')
				FROM ".$feeder."
				WHERE CONVERT(DATETIME, FLOOR(CONVERT(FLOAT, time))) = '".$tripTimeDate."'
				AND FORMAT( time, 'HH:mm') = FORMAT( DATEADD(SECOND, -60, '".$tripTime."'), 'HH:mm')
			";
		}elseif ($fname == "Cordon") {
			$query = "
				SELECT time, MW as Kwtotal, FORMAT( time, 'HH:mm:ss')
				FROM ".$feeder."
				WHERE CONVERT(DATETIME, FLOOR(CONVERT(FLOAT, time))) = '".$tripTimeDate."'
				AND FORMAT( time, 'HH:mm') = FORMAT( DATEADD(SECOND, -60, '".$tripTime."'), 'HH:mm')
			";
		}
		

		$list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);

		while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["Kwtotal"]);
        	array_push($list, $records);
        }
		// var_dump($list);
		$connect->Close();
        return $list;
	}


	public function formatSeconds($seconds) {
	  $t = round($seconds);
	  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
	}

}

 ?>