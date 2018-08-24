<?php
/**
 * Created by VSCode.
 * User: egimaben
 * Date: 22.08.18
 * Time: 22:34
 */
namespace egimaben\sqlseeder; 

require_once "Config.php";
 require_once __DIR__.'/../../../vendor/autoload.php';

class DBSeeder{
    private $tableArr;
    private $conn;
    private $faker;
    function __construct($tableArr=null) {
        $this->tableArr = $tableArr;
        $this->faker = \Faker\Factory::create();
        $this->conn = mysqli_connect(
            Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD,Config::DB_NAME
    );
    }
    public function refill(){
        $tables = $this->getDatabaseTables();
        DBSeeder::truncateTables($this->conn,$tables);
        foreach($tables as $table){
            $columnNameTypeMap = $this->getTableColumns($table);
            $recordsArray = array();
            for($i=0;$i<Config::NUM_RECORDS;$i++){
                $record = array();
                foreach($columnNameTypeMap as $columnName=>$type){
                    $record[] = $this->generateColumnValue($columnName,$type);
                    
                }
                $recordsArray[]=$record;
            }
            
            $query = $this->bulkInsert($table,array_keys($columnNameTypeMap),$recordsArray);
        }

    }
    private function generateColumnValue($columnName,$mysqlType){
        $fakeValue = null;
        $mysqlType = strtolower($mysqlType);
        $mysqlType = preg_replace('/signed|unsigned/','',$mysqlType);
        $columnName = strtolower($columnName);
        if(preg_match('/mail/',$columnName))
          $fakeValue = $this->faker->email;
        elseif(preg_match('/first_name|firstname|fname/',$columnName))
          $fakeValue = $this->faker->firstName;
        elseif(preg_match('/last_name|lastname|lname/',$columnName))
          $fakeValue = $this->faker->lastName;
        elseif(preg_match('/username|uname|user_name/',$columnName))
          $fakeValue = $this->faker->userName;
        elseif(preg_match('/name/',$columnName))
          $fakeValue = $this->faker->name;
        elseif(preg_match('/country|ctry/',$columnName))
          $fakeValue = $this->faker->country;
        elseif(preg_match('/city|town/',$columnName))
          $fakeValue = $this->faker->city;
        elseif(preg_match('/address/',$columnName))
          $fakeValue = $this->faker->address;
        elseif(preg_match('/latitude|lat/',$columnName))
          $fakeValue = $this->faker->latitude;
        elseif(preg_match('/longitude|long/',$columnName))
          $fakeValue = $this->faker->longitude;
        elseif(preg_match('/phone|telephone/',$columnName))
          $fakeValue = $this->faker->phoneNumber;
        elseif(preg_match('/password/',$columnName))
          $fakeValue = $this->faker->password;
        else $fakeValue = $this->generateColumnValueFromType($mysqlType);
       
        if(!DBSeeder::isNumberColumn($mysqlType)){
            
            $fakeValue = preg_replace("/(')/","",$fakeValue);
            $fakeValue = DBSeeder::quoteString($fakeValue);
        }
        return $fakeValue;
        
        
    }
    private static function quoteString($str){
        return "'".$str."'";
    }
    private static function truncateTables($conn,$tables){
        DBSeeder::unsetFKChecks($conn);
        foreach($tables as $table){
        if(!mysqli_query($conn,"truncate table $table;")){
            echo "FAILED to truncate table $table\n";
            echo("Error description: " . mysqli_error($conn));
        }
        else{
            echo "Successfully truncated table $table\n";
        }
        DBSeeder::setFKChecks($conn);

    }
    }
    private static function setFKChecks($conn){
        if(mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=1")) {
            echo "successfully set FK checks\n";
          } 
        else{
            echo "Failed to set FK checks, may risk corrupting database\n";
        }
    }
    private static function unsetFKChecks($conn){
        if(mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0")) {
            echo "successfully unset FK checks\n";
          } 
        else{
            echo "Failed to unset FK checks, DB seeding may not work as expected\n";
        }
    }
    private static function isNumberColumn($columnType){
        return preg_match('/int|tinyint|double|float|decimal|bigint|smallint|mediumint|year/',$columnType);
    }
    /**
     * Generate data according to column type
     */
    private function generateColumnValueFromType($mysqlType){
        $columnLength = $this->extractColumnLength($mysqlType);
        
        if(is_numeric($columnLength) && DBSeeder::isNumberColumn($mysqlType) && $columnLength>=10){
            $columnLength =9 ;
        }
        if(strpos($mysqlType,"(")){
            $mysqlType = substr($mysqlType,0,strpos($mysqlType,"("));
        }
        $fakeValue;        
        
        switch($mysqlType){
            case 'int': case 'bigint': case 'mediumint':case 'smallint':$fakeValue = $this->faker->unique()->randomNumber($nbDigits = $columnLength);break;
            case 'decimal':case 'double':case 'float':
            $floatingPoint = $this->faker->numberBetween(0,intval(str_repeat("9",$this->extractDecimalPlaces($mysqlType))));
            $intVal = intval(str_repeat("9",$columnLength));
            $doubleVal = doubleval($intVal.$floatingPoint);
            $fakeValue=$this->faker->numberBetween(0,$doubleVal);
            case 'tinyint': $fakeValue = array_rand(array(1,0),1);break;
            case 'timestamp':case 'datetime':$fakeValue=$this->faker->dateTime->format("Y:m:d H:i:s");break;
            case 'date':$fakeValue=$this->faker->dateTime->format("Y:m:d");break;
            case 'time':$fakeValue=$this->faker->dateTime->format("H:i:s");break;
            case 'year':$fakeValue=$this->faker->year;break;
            case 'varchar':$fakeValue=$this->faker->text($columnLength);break;
        }
        return $fakeValue;
    }
    private function extractColumnLength($mysqlColumnLenDescriptor){
        return preg_replace("/[^0-9]/","",substr($mysqlColumnLenDescriptor,strpos($mysqlColumnLenDescriptor,"("),strlen($mysqlColumnLenDescriptor)-strpos($mysqlColumnLenDescriptor,",")));
    }
    private function extractDecimalPlaces($mysqlDoubleColumnLenDescriptor){
        $decimalPlaces =preg_replace("/^(.*,)/",'',$mysqlDoubleColumnLenDescriptor);
        $decimalPlaces = preg_replace("/[)]/",'',$decimalPlaces);
        return $decimalPlaces;
    }
    public function bulkInsert($table,$columnNameArray,$recordsArray){
        $sql = array(); 
        foreach( $recordsArray as $row ) {
            $sql[] = '('.implode(',',$row).')';
        }
        $query = 'INSERT INTO '.$table.' ('.implode(",",$columnNameArray).') VALUES '.implode(',', $sql);
        if(mysqli_query($this->conn,$query)){
            echo "SUCCESSFULLY seeded table $table\n";
        }else{
            echo "FAILED to seed table $table\n";
            echo("Error description: " . mysqli_error($this->conn));
        }
    }
    public function getDatabaseTables($database=null){
        if(isset($this->tableArr)){
            return $this->tableArr;
        }
        $db = isset($database)?$database:Config::DB_NAME;
        $query = 'SHOW TABLES FROM '.$db;
        $result = mysqli_query($this->conn,$query);
        $tables = array();
        if($result){
            $output = array();
            while($row = mysqli_fetch_array($result))
            {
              
              $tables[] = $row[0];              
            }
            mysqli_free_result($result);
        }
        else $result = null;
        
        return $tables;
    }
    public function getTableColumns($table){
        $cols = mysqli_query($this->conn,"SHOW COLUMNS FROM $table");
        $columns = array();
        if($cols)
        {
          while($col = mysqli_fetch_assoc($cols))
          {
            $columns[$col['Field']]=$col['Type'];
          }
          
          mysqli_free_result($cols);
        }
        return $columns;
    }
    
    }


$db = new DBSeeder();
// $result = $db->getDatabaseTables();
// $db->getTableColumns("posts");
// var_dump($result);
// $result = $db->test();
// $query = $db->bulkInsert("s_invoices",array("name","age","height"),array(array("ben",28,55.6),array("egima",34,33.5)));
// echo $query;
$db->refill();
// // $str = "'hey'";
// echo $str;
