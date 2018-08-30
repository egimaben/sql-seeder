<?php
namespace egimaben\sql_seeder;

class Command{
    public static function main($exit = true)
    {
        $command = new static;
        $argv = $_SERVER['argv'];
        if(count($argv)>=5){
            $host = $argv[1];
            $user = $argv[2];
            $password = $argv[3];
            $db = $argv[4];
            $num_rows = array_key_exists(5,$argv)?$argv[5]:null;
            if($num_rows!=null && !is_numeric($num_rows)){
                $command->dieWithError('     num_rows should be a number'.PHP_EOL);
            }
            $tables = array_key_exists(6,$argv)?$argv[6]:null;
            if($tables!=null && !preg_match('/^\[.*\]$/',$tables)){
                $command->dieWithError('     Tables should be provided as an array in quotes e.g. "[t1,t2,t3...]"'.PHP_EOL);
            }
            $tables = preg_replace('/\[|\]/',$tables);
            $tableArr = $tables!=""?explode(',',$tables):null;
            
            $dbSeeder = new DBSeeder($host,$user,$password,$db,$num_rows,$tableArr);
            $dbSeeder->refill();
        }
        else{
            $command->dieWithError('USAGE:'.PHP_EOL.'     composer seed $host $user $password $database [num_records] "[[table1, table2, table3...]]"'.PHP_EOL);
        }
       

        // return $command->run($_SERVER['argv'], $exit);
    }
    
    private function dieWithError($message){
        fwrite(
            STDERR,
            $message
        );
    
        die(1);
    }
}