<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IselcoData
 *
 * @author MDC DCIM
 */
ini_set('max_execution_time', 1000);
require_once '../bom/connect.php';
require_once '../bom/ISELCO.php';
error_reporting(1);

class IselcoData {
    private $IselcoData;

    public function __construct(){
        $this->IselcoData = new ISELCO(0, "", "", 0, 0, 0, 0, 0, 0, 0, 0);
    }
//UPDATE//

    public function updateTotalizerData($id, $data){
      $connect = new Connect();

      /*$query = "UPDATE [".$connect->db_name."].[dbo].[tbl_metering_data] SET tap_pos=".$data[0].", oil_temp=".$data[1].", oil_level=".$data[2].", pri_wdg_temp=".$data[3].", sec_wdg_temp=".$data[4].", weather=".$data[5]." WHERE id=".$id."";*/
      $query = "UPDATE [".$connect->db_name."].[dbo].[tbl_metering_data] SET";
      for($i=0; $i<6; $i++){
        if($data[$i] == '' or $data[$i] == null){
          
        }
        else{
          $order = $order + 1;
          if($order>1){
            $query = $query . ",";
          }
          switch($i){
              case 0:
                  $query = $query . " tap_pos=".$data[0].""; 
                  break;
              case 1:
                  $query = $query . " oil_temp=".$data[1]."";
                  break;
              case 2:
                  $query = $query . " oil_level=".$data[2]."";
                  break;
              case 3:
                  $query = $query . " pri_wdg_temp=".$data[3]."";
                  break;
              case 4:
                $query = $query . " sec_wdg_temp=".$data[4]."";
                break;
              default:
                  $query = $query . " weather=".$data[5]."";
          }
        }
      }
      $query = $query . " WHERE id=".$id."";
      $db = $connect->Open();
      $result = sqlsrv_query($db, $query);
      if( $result === false ) {
          if( ($errors = sqlsrv_errors() ) != null) {
              foreach( $errors as $error ) {
                  //echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                  //echo "code: ".$error[ 'code']."<br />";
                  ///echo "message: ".$error[ 'message']."<br />";
              }
          }
      }
      $connect->Close();
      return $result;
    }

    public function editUser($id,$username,$password,$usertype,$location){
      /*$location = $this->getLocationName($location);*/
      $connect = new Connect();
      $query = "UPDATE [".$connect->db_name."].[dbo].[tbl_users] SET user_type='".$usertype."', username='".$username."', password='".$password."', location='".$location."' WHERE id='".$id."' ";
      $db = $connect->Open();
      $result = sqlsrv_query($db, $query);
      if( $result === false ) {
          if( ($errors = sqlsrv_errors() ) != null) {
              foreach( $errors as $error ) {
                  //echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                  //echo "code: ".$error[ 'code']."<br />";
                  //echo "message: ".$error[ 'message']."<br />";
              }
          }
      }
      $connect->Close();
      return $result;
    }

    public function deactivateUser($id){
      $connect = new Connect();
      $query = "UPDATE [".$connect->db_name."].[dbo].[tbl_users] SET status = 'deactivated' WHERE id='".$id."'";
      $db = $connect->Open();
      $result = sqlsrv_query($db, $query);
      $connect->Close();
      return $result;
    }

    public function resetPassword($id,$password){
      $connect = new Connect();
      $query = "UPDATE [".$connect->db_name."].[dbo].[tbl_users] SET password = '".$password."' WHERE id = '".$id."'";
      $db = $connect->Open();
      $result = sqlsrv_query($db, $query);
      $connect->Close();
      return $result;
    }


//SELECT //
    public function userChecker($userName){
        $connect = new Connect();
        $query = "SELECT * from [".$connect->db_name."].[dbo].[tbl_users] where username = '". $userName ."' ";
        $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
                $records = array($fetch["user_type"], $fetch["password"], $fetch["username"], $fetch["id"], $fetch["location"]);
                array_push($list, $records);
            }
        $connect->Close();
        return $list;
    }
    
    public function login($userName, $password) {
        $connect = new Connect();
        $list = array();
        $query = "SELECT * from [".$connect->db_name."].[dbo].[tbl_users] where username = '". $userName ."' and password = '". $password ."' and status = 'activated' ";
        try{
            $db = $connect->Open();
            $result = sqlsrv_query($db, $query);

            while ($fetch = sqlsrv_fetch_array($result)) {
                $records = array($fetch["user_type"], $fetch["password"], $fetch["username"], $fetch["id"], $fetch["location"]);
                array_push($list, $records);
            }
            $connect->Close();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $list;
    }

    public function getusers(){
      $connect = new Connect();
      $list = array();
      $query = "SELECT  [user_type], [password], [username], [id], [location_name]
              FROM [".$connect->db_name."].[dbo].[tbl_users] tu
              INNER JOIN [".$connect->db_name."].[dbo].[tbl_location] tl ON tl.location_id = tu.location
              WHERE [status] = 'activated'
              ORDER BY [id]";
      try{
            $db = $connect->Open();
            $result = sqlsrv_query($db, $query);

            while ($fetch = sqlsrv_fetch_array($result)) {
                $records = array($fetch["user_type"], $fetch["password"], $fetch["username"], $fetch["id"], $fetch["location_name"]);
                array_push($list, $records);
            }
            $connect->Close();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $list;
    }

    public function getUser($id){
      $connect = new Connect();
      $list = array();
      $query = "SELECT [user_type],[username],[password],[location] FROM [".$connect->db_name."].[dbo].[tbl_users] WHERE id='".$id."' and status = 'activated'";
      
      try{
            $db = $connect->Open();
            $result = sqlsrv_query($db, $query);

            while ($fetch = sqlsrv_fetch_array($result)) {
                $records = array($fetch["user_type"], $fetch["password"], $fetch["username"], $fetch["location"]);
                array_push($list, $records);
            }
            $connect->Close();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $list;
    }

    public function selectTotalizerData($date, $location, $time, $report, $feederName){
     $connect = new Connect();
     if($report=="hour"){

     }
     else{
        $time = date("H:i:s",strtotime($time . "-1 minute"));
     }

     // $query = "SELECT DISTINCT [id],[file_id],[meter_date],[meter_time],[Ia],[Ib],[Ic],[neutral_current],[va],[vb],[vc],[energy_total],[pSum],[qSum],[sSum],[pft],[feeder_name] 
     //  ,[tap_pos],[oil_temp],[oil_level],[pri_wdg_temp],[sec_wdg_temp],[weather] FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name LIKE '". $feederName ."' and meter_time ='". $time ."' order by feeder_name ";

    $query = "SELECT DISTINCT [id],[file_id],[meter_date],[meter_time],[Ia],[Ib],[Ic],[neutral_current],[va],[vb],[vc],[energy_total],[pSum],[qSum],[sSum],[pft],[feeder_name] 
      ,[tap_pos],[oil_temp],[oil_level],[pri_wdg_temp],[sec_wdg_temp],[weather] FROM [".$connect->db_name."].[dbo].[tbl_metering_data]";

     $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["id"], $fetch["file_id"], $fetch["meter_date"], $fetch["meter_time"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["neutral_current"], $fetch["va"], $fetch["vb"], $fetch["vc"], $fetch["energy_total"], $fetch["pSum"], $fetch["qSum"], $fetch["sSum"], $fetch["pft"], $fetch["feeder_name"],$fetch["tap_pos"],$fetch["oil_temp"],$fetch["oil_level"],$fetch["pri_wdg_temp"],$fetch["sec_wdg_temp"],$fetch["weather"]);
        array_push($list, $records);
        }
        if( $result === false ) {
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
        }
        $connect->Close();
        return $list;
    }

    public function selectMeterNames($userType){
     $connect = new Connect();

      $query = "SELECT meter_id, meter_name
              FROM [".$connect->db_name."].[dbo].[tbl_meters]
              ORDER BY meter_id";

     $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["meter_id"], $fetch["meter_name"]);
        array_push($list, $records);
        }

        $connect->Close();
        return $list;
    }

    public function selectLocationNames($userType, $id){
     $connect = new Connect();

     if($userType=="system admin"){
      $query = "SELECT DISTINCT location_name, location_id
              FROM [".$connect->db_name."].[dbo].[tbl_location]
              ORDER BY location_name";
     }
     else{
      $query = "SELECT DISTINCT tl.location_name, tl.location_id
              FROM [".$connect->db_name."].[dbo].[tbl_location] tl
              INNER JOIN [".$connect->db_name."].[dbo].[tbl_users] tu ON tl.location_id = tu.location
              where location_id = ".$id ."
              ORDER BY location_name";
     }
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

    public function getLocations(){
        $connect = new Connect();
        $query = "SELECT * from [".$connect->db_name."].[dbo].[tbl_location] order by location_id";
        $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while($fetch = sqlsrv_fetch_array($result)){
            $records = array($fetch["location_id"], $fetch["location_name"]);
            array_push($list, $records);
        }$connect->Close();
        return $list;
    }

    public function selectLocationAndFeeders($location){
     $connect = new Connect();
     $query = "SELECT DISTINCT tl.location_name, tl.location_id, fn.feeder_id, fn.feeder_name
              FROM [".$connect->db_name."].[dbo].[tbl_location] tl
              LEFT JOIN [".$connect->db_name."].[dbo].[tbl_feeder_name] fn ON tl.location_id = fn.location_id
              where tl.location_id = ". $location ."
              ORDER BY fn.feeder_name";
     $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["location_id"], $fetch["location_name"], $fetch["feeder_id"], $fetch["feeder_name"]);
        array_push($list, $records);
        }
        $connect->Close();
        return $list;
    }


    public function SelectAllFeederNames($id){
     $connect = new Connect();
     $query = "SELECT DISTINCT [feeder_id]
              ,[feeder_name]
              ,[location_id]
          FROM [".$connect->db_name."].[dbo].[tbl_feeder_name]
          where location_id = ". $id ." ";
     $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["feeder_name"]);
        array_push($list, $records);
        }
        $connect->Close();
        return $list;
    }

    public function selectHourlyDates($date,$feederNames){
      $connect = new Connect();
      $db = $connect->Open();
    

      $query = "SELECT * FROM [".$connect->db_name."].[dbo].[". $feederNames ."] WHERE CONVERT(DATETIME, FLOOR(CONVERT(FLOAT, time))) = '". $date ."' AND DATEPART(mi, time) = 00 ORDER BY time DESC";

      

     $connect->Close();
     return $list;

    }

    // public function selectHourlyDates($date,$feederNames){
    //  $connect = new Connect(); 
    //  if($feederNames == "Anupul"){
    //     $getHourly = "SELECT DISTINCT CAST(MIN(meter_time) AS VARCHAR(20)) AS DATE
    //             FROM [".$connect->db_name."].[dbo].[tbl_metering_data]
    //             where meter_date = '". $date ."' AND feeder_name = 'Anupul69' GROUP BY DATEPART(HOUR,CONVERT(DATETIME, CONVERT(CHAR(8), meter_date, 112) 
    //             + ' ' + CONVERT(CHAR(8), meter_time, 108)))
    //             ORDER BY DATE";
    //  }
    //  else{
    //     $getHourly = "SELECT DISTINCT CAST(MIN(meter_time) AS VARCHAR(20)) AS DATE
    //             FROM [".$connect->db_name."].[dbo].[tbl_metering_data]
    //             where meter_date = '". $date ."' AND (";

    //             //var_dump($feederNames);
    //             foreach ($feederNames as $key => $value) {
    //                 foreach ($value as $name) {
    //                     $count = $count+1;
    //                 }
    //             }
    //             for($i = 0; $i <= $count-1; $i++){
    //                 if($feederNames[0][$i] != ""){
    //                     if($i == $count-1){
    //                         $getHourly = $getHourly . " feeder_name = '".$feederNames[0][$i]."')";
    //                     }
    //                     else{
    //                         $getHourly = $getHourly . " feeder_name = '".$feederNames[0][$i]."' OR";
    //                     }
    //                 }

    //             }

    //             $getHourly = $getHourly . " GROUP BY DATEPART(HOUR,CONVERT(DATETIME, CONVERT(CHAR(8), meter_date, 112) 
    //             + ' ' + CONVERT(CHAR(8), meter_time, 108)))
    //             ORDER BY DATE";
    //  }

    //  $db = $connect->Open();
    //  $hourly = sqlsrv_query($db, $getHourly);
    //  $list = array();
    //     while ($fetch = sqlsrv_fetch($hourly)) {
    //         $records = sqlsrv_get_field($hourly, 0);
    //         array_push($list, $records);
    //     }

    //     if( $hourly === false ) {
    //         if( ($errors = sqlsrv_errors() ) != null) {
    //             foreach( $errors as $error ) {
    //                 echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
    //                 echo "code: ".$error[ 'code']."<br />";
    //                 echo "message: ".$error[ 'message']."<br />";
    //             }
    //         }
    //     }

    //  $connect->Close();
    //  return $list;
    // }

    public function selectMinuteDates($date){
     $connect = new Connect();   
     // $getHourly = "SELECT DISTINCT meter_time AS DATE
     //            FROM [".$connect->db_name."].[dbo].[tbl_metering_data]
     //            WHERE meter_date = '". $date ."' 
     //            ORDER BY DATE";

     $getHourly = "SELECT DISTINCT CAST(convert(time,convert(datetime,ROUND
     (cast(convert(datetime,meter_time) as float) * (24/.25),0)/(24/.25))) as VARCHAR(20)) AS DATE
     FROM [".$connect->db_name."].[dbo].[tbl_metering_data] WHERE meter_date = '". $date ."'
     ORDER BY DATE";

     $db = $connect->Open();
     $hourly = sqlsrv_query($db, $getHourly);
     $list = array();
        while ($fetch = sqlsrv_fetch($hourly)) {
            $records = sqlsrv_get_field($hourly, 0);
            array_push($list, $records);
        }

        if( $hourly === false ) {
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                }
            }
        }

     $connect->Close();
     return $list;
    }

    public function selectFeederData($feederName, $date, $newDate,$report){
     $connect = new Connect();
     //$query = "SELECT * FROM [".$connect->db_name."].[dbo].[tbl_Cordon_meterData] where meter_date = '". $date ."' and meter_time = '". $time ."' and feeder_name = 'FEEDER1'";
     $list = array();
        if($report=="hour"){
            $newDate = $newDate;
        }
        else{
            $newDate = date("H:i:s",strtotime($newDate . "-1 minute"));     
        }

        $query = "SELECT DISTINCT [id],[file_id],[meter_date],[meter_time],[Ia],[Ib],[Ic],[neutral_current],[energy_total],[pSum],[qSum],[sSum],[pft],[feeder_name]
            FROM [".$connect->db_name."].[dbo].[tbl_metering_data]
            where feeder_name = '". $feederName ."' and meter_date = '". $date ."' and meter_time = '". $newDate ."'";
            
            $db = $connect->Open();
            $result = sqlsrv_query($db, $query);
                while ($fetch = sqlsrv_fetch_array($result)) {
                    $records = array($fetch["id"], $fetch["file_id"], $fetch["meter_date"], $fetch["meter_time"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["neutral_current"], $fetch["energy_total"], $fetch["pSum"], $fetch["qSum"], $fetch["sSum"], $fetch["pft"], $fetch["feeder_name"]);
                array_push($list, $records);
                }

            if( $result === false ) {
                if( ($errors = sqlsrv_errors() ) != null) {
                    foreach( $errors as $error ) {
                        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                        echo "code: ".$error[ 'code']."<br />";
                        echo "message: ".$error[ 'message']."<br />";
                    }
                }
            }
        $connect->Close();
        //var_dump($list);
        return $list;
    }

    ///////////////////////////////////// TEST ///////////////////////////////////////

    public function selectFeederDataTest($feederName, $date, $newDate,$report){
     $connect = new Connect();
     //$query = "SELECT * FROM [".$connect->db_name."].[dbo].[tbl_Cordon_meterData] where meter_date = '". $date ."' and meter_time = '". $time ."' and feeder_name = 'FEEDER1'";
     $list = array();
        if($report=="hour"){
            $newDate = $newDate;
        }
        else{
            $newDate = date("H:i:s",strtotime($newDate . "-1 minute"));     
        }

        $query = "SELECT DISTINCT [id],[file_id],[meter_date],[meter_time],[Ia],[Ib],[Ic],[neutral_current],[energy_total],[pSum],[qSum],[sSum],[pft],[feeder_name]
            FROM [".$connect->db_name."].[dbo].[tbl_metering_data]
            where feeder_name = '". $feederName ."' and meter_date = '". $date ."' and meter_time = '". $newDate ."'";

        // $query = "SELECT DISTINCT [Ia],[Ib],[Ic],[Va],[Vb],[Vc],[PF],[MW],[MVar],[MVa] FROM [".$connect->db_name."].[dbo].[batal_totalizer] WHERE [time] LIKE '2017%' ";
            
            $db = $connect->Open();
            $result = sqlsrv_query($db, $query);
                while ($fetch = sqlsrv_fetch_array($result)) {
                    $records = array($fetch["id"], $fetch["file_id"], $fetch["meter_date"], $fetch["meter_time"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["neutral_current"], $fetch["energy_total"], $fetch["pSum"], $fetch["qSum"], $fetch["sSum"], $fetch["pft"], $fetch["feeder_name"]);
                array_push($list, $records);
                }

        // $db = $connect->Open();
        //     $result = sqlsrv_query($db, $query);
        //         while ($fetch = sqlsrv_fetch_array($result)) {
        //             $records = array($fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["Va"], $fetch["Vb"], $fetch["Vc"], $fetch["PF"], $fetch["MW"], $fetch["MVar"], $fetch["MVa"]);
        //         array_push($list, $records);
        //         }

            if( $result === false ) {
                if( ($errors = sqlsrv_errors() ) != null) {
                    foreach( $errors as $error ) {
                        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                        echo "code: ".$error[ 'code']."<br />";
                        echo "message: ".$error[ 'message']."<br />";
                    }
                }
            }
        $connect->Close();
        //var_dump($list);
        return $list;
    }


    ///////////////////////////////////// TEST ///////////////////////////////////////

    // public function selectFeeder2Data($time, $date){
    //  $connect = new Connect();
    //  $query = "SELECT * FROM [".$connect->db_name."].[dbo].[tbl_Cordon_meterData] where meter_date = '". $date ."' and meter_time = '". $time ."' and feeder_name = 'FEEDER2'";
    //  $list = array();
    //     $db = $connect->Open();
    //     $result = sqlsrv_query($db, $query);
    //     while ($fetch = sqlsrv_fetch_array($result)) {
    //         $records = array($fetch["meter_date"], $fetch["meter_time"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["mwt"], $fetch["pf"]);
    //     array_push($list, $records);
    //     }
    //     $connect->Close();
    //     return $list;
    // }

    // public function selectFeeder3Data($time, $date){
    //  $connect = new Connect();
    //  $query = "SELECT * FROM [".$connect->db_name."].[dbo].[tbl_Cordon_meterData] where meter_date = '". $date ."' and meter_time = '". $time ."' and feeder_name = 'FEEDER3'";
    //  $list = array();
    //     $db = $connect->Open();
    //     $result = sqlsrv_query($db, $query);
    //     while ($fetch = sqlsrv_fetch_array($result)) {
    //         $records = array($fetch["meter_date"], $fetch["meter_time"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["mwt"], $fetch["pf"]);
    //     array_push($list, $records);
    //     }
    //     $connect->Close();
    //     return $list;
    // }

    // public function selectFeeder4Data($time, $date){
    //  $connect = new Connect();
    //  $query = "SELECT * FROM [".$connect->db_name."].[dbo].[tbl_Cordon_meterData] where meter_date = '". $date ."' and meter_time = '". $time ."' and feeder_name = 'FEEDER4'";
    //  $list = array();
    //     $db = $connect->Open();
    //     $result = sqlsrv_query($db, $query);
    //     while ($fetch = sqlsrv_fetch_array($result)) {
    //         $records = array($fetch["meter_date"], $fetch["meter_time"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["mwt"], $fetch["pf"], $fetch["temp_oil"], $fetch["wndg"], $fetch["tap_set"], $fetch["w_cond"]);
    //     array_push($list, $records);
    //     }
    //     $connect->Close();
    //     return $list;
    // }

    public function selectData($date, $columnPick, $location){
        $connect = new Connect();
         $query = "SELECT * FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
         $list = array();
         $db = $connect->Open();
         $result = sqlsrv_query($db, $query);
         while ($fetch = sqlsrv_fetch_array($result)) {
            $records = array($fetch["meter_date"], $fetch["meter_time"], $fetch["vab"], $fetch["vbc"], $fetch["vca"], $fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["mwt"], $fetch["pft"], $fetch["feeder_name"]);
         array_push($list, $records);
         }
         $connect->Close();
         return $list;
    }

    public function selectAllData($columnPick, $date, $reading, $location){
        $connect = new Connect();
        //echo $location . $columnPick;
        switch ($columnPick) {
            case 'TOTALIZER': //MWT is ACTIVE POWER TOTAL
                switch ($reading) {
                    case 'Voltage':
                        $query = "SELECT vab, vbc, vca, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["vab"], $fetch["vbc"], $fetch["vca"], $fetch["meter_date"], $fetch["meter_time"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    case 'Current':
                        $query = "SELECT Ia, Ib, Ic, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["meter_date"], $fetch["meter_time"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    case 'PowerFactor': //ADD PFA, PFB, PFC, PFT
                        $query = "SELECT pft, pfa, pfb, pfc, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["pft"], $fetch["meter_date"], $fetch["meter_time"], $fetch["pfa"], $fetch["pfb"], $fetch["pfc"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    case 'MW':
                        $query = "SELECT mwt, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["mwt"], $fetch["meter_date"], $fetch["meter_time"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;
            
            default:
                switch ($reading) {
                    case 'Voltage':
                        $query = "SELECT vab, vbc, vca, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["vab"], $fetch["vbc"], $fetch["vca"], $fetch["meter_date"], $fetch["meter_time"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    case 'Current':
                        $query = "SELECT Ia, Ib, Ic, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["Ia"], $fetch["Ib"], $fetch["Ic"], $fetch["meter_date"], $fetch["meter_time"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    case 'PowerFactor':
                        $query = "SELECT pft, pfa, pfb, pfc, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["pft"], $fetch["meter_date"], $fetch["meter_time"], $fetch["pfa"], $fetch["pfb"], $fetch["pfc"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    case 'MW':
                        $query = "SELECT mwt, meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where meter_date = '". $date ."' and feeder_name = '". $columnPick ."'";
                        $list = array();
                        $db = $connect->Open();
                        $result = sqlsrv_query($db, $query);
                        while ($fetch = sqlsrv_fetch_array($result)) {
                            $records = array($fetch["mwt"], $fetch["meter_date"], $fetch["meter_time"]);
                        array_push($list, $records);
                        }
                        $connect->Close();
                        return $list;
                        break;
                    
                    default:
                        # code...
                        break;
                }
                break;
        }
    }

    public function selectMaxColumn($graphColumn, $date, $fName){
         $connect = new Connect();
         $query = "SELECT max(". $graphColumn ."), max(CONVERT(varchar(15),CAST(meter_time AS TIME),100)) FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where feeder_name = '". $fName ."' and meter_date = '". $date ."'";
         $list = array();
         $db = $connect->Open();
         $result = sqlsrv_query($db, $query);
         while ($fetch = sqlsrv_fetch($result)) {
            $maxValue = sqlsrv_get_field($result, 0);
            $time = sqlsrv_get_field($result, 1);
            $records = array($maxValue, $time);
            array_push($list, $records);
         }
         $connect->Close();
         return $list;
    }

    public function selectGraphData($date, $fName, $graphColumn){
        $connect = new Connect();
        $query = "SELECT ". $graphColumn .", meter_date, meter_time FROM [".$connect->db_name."].[dbo].[tbl_metering_data] where feeder_name = '". $fName ."' and meter_date = '". $date ."'";
        $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch($result)) {
            $maxValue = sqlsrv_get_field($result, 0);
            $date = sqlsrv_get_field($result, 1);
            $time = sqlsrv_get_field($result, 2);
            $records = array($maxValue, $date, $time);
            array_push($list, $records);
        }
        $connect->Close();
        return $list;
    }

//GET//

    public function getLocationName($id){
     $connect = new Connect();
     $location = "";
     $query = "SELECT *
              FROM [".$connect->db_name."].[dbo].[tbl_location] 
              where location_id = ". $id ."
              ORDER BY location_name";
     $list = array();
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        while ($fetch = sqlsrv_fetch_array($result)) {
            $location = $fetch["location_name"];
        }
        $connect->Close();
        return $location;
    }

    public function getmyFileId($fileId){
        $connect = new Connect();
         $getFileId = "";
         $query = "SELECT distinct file_id
                  FROM [".$connect->db_name."].[dbo].[tbl_metering_data] 
                  where file_id = '". $fileId ."' ";
         $list = array();
            $db = $connect->Open();
            $result = sqlsrv_query($db, $query);
            while ($fetch = sqlsrv_fetch_array($result)) {
                $getFileId = $fetch["file_id"];
            }
            $connect->Close();
            return $getFileId;
    }
    

//INSERT//

    public function addUser($userType, $userName, $password, $location){
        $connect = new Connect();
        
        $query = "INSERT into [".$connect->db_name."].[dbo].[tbl_users] (user_type, username, password, location, status) values ('". $userType ."', '". $userName ."', '". $password ."', '". $location ."', 'activated')";

        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        $connect->Close();
        return $result;
    }

    public function insertData($date, $time, $Vab, $Vbc, $Vca, $Ia, $Ib, $Ic, $mwt, $pf, $fName){
        $connect = new Connect();
        $query = "INSERT INTO [".$connect->db_name."].[dbo].[tbl_metering_data] (meter_date, meter_time, feeder_name, Vab, Vbc, Vca, Ia, Ib, Ic, mwt, pf, temp_oil, wndg, tap_set, w_cond) values ('". $date ."', '". $time ."', '". $fName ."', ". $Vab .", ". $Vbc .", ". $Vca .", ". $Ia .", ". $Ib .", ". $Ic .", ". $mwt .", ". $pf .", 55, 59, 1, 104)";
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        $connect->Close();
        return $result;
    }

    public function uploadData($query){
        $connect = new Connect();
        //echo $query1 = "INSERT INTO [".$connect->db_name."].[dbo].[tbl_metering_data] (frequency,va,vb,vc,ave_voltage,vab,vbc,vca,ave_line_voltage,Ia,Ib,Ic,ave_current,neutral_current,pa,pb,pc,pSum,qa,qb,qc,qSum,sa,sb,sc,sSum,pfa,pfb,pfc,pft,voltage_factor,current_factor,load_char,power_demand,reactive_powerDemand,apparent_powerDemand,energy_imp,energy_exp,reactive_energyImp,reactive_energyExp,energy_total,energy_net,reactive_energy_total,reactive_energy_net,apparent_energy,energy_imp_a,energy_exp_a,energy_imp_b,energy_exp_b,energy_imp_c,energy_exp_c,reactive_energy_imp_a,reactive_energy_exp_a,reactive_energy_imp_b,reactive_energy_exp_b,reactive_energy_imp_c,reactive_energy_exp_c,apparent_energy_a,apparent_energy_b,apparent_energy_c,feeder_name,meter_date,meter_time) VALUES(" . $query . ")";
        //echo $query = $query;
        
        $db = $connect->Open();
        $result = sqlsrv_query($db, $query);
        //$result = sqlsrv_query( $conn, $sql );
        if( $result === false ) {
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    //echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    //echo "code: ".$error[ 'code']."<br />";
                    //echo "message: ".$error[ 'message']."<br />";
                }
            }
        }

        $connect->Close();
        return $result;
        //echo "<br>";
    }
    
}
