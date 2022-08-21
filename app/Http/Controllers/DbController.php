<?php

namespace App\Http\Controllers;

/*use Illuminate\Http\Request;
use App\Traits\UserHelper;
use App\Models\Users;
use App\Models\Userlavel;
use App\Models\Profession;
use App\Category;
use App\Models\Review;
use App\Helper\imagehelper;
use Hash;
use DB;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Helper\general;
use App\Models\Aum;*/

class DbController extends Controller
{
    //use UserHelper; 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dbBackup()
    {
        if(function_exists('exec')) {
            echo "exec is enabled";
        }
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
/*
        $database = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $dir = public_path('uploads/dump.sql');
      
        echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

        exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

        var_dump($output);*/


        /*$mysqlDatabaseName =env('DB_DATABASE');
        $mysqlUserName =env('DB_USERNAME');
        $mysqlPassword =env('DB_PASSWORD');
        $mysqlHostName =env('DB_HOST');
        $mysqlExportPath =public_path('uploads/');

        //Please do not change the following points
        //Export of the database and output of the status
        $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath;
        exec($command,$output,$worked);
        switch($worked){
        case 0:
        echo 'The database <b>' .$mysqlDatabaseName .'</b> was successfully stored in the following path '.getcwd().'/' .$mysqlExportPath .'</b>';
        break;
        case 1:
        echo 'An error occurred when exporting <b>' .$mysqlDatabaseName .'</b> zu '.getcwd().'/' .$mysqlExportPath .'</b>';
        break;
        case 2:
        echo 'An export error has occurred, please check the following information: <br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
        break;
        }*/

        define("BACKUP_PATH", public_path('uploads/'));

        $server_name   = env('DB_HOST');
        $username      = env('DB_USERNAME');
        $password      = env('DB_PASSWORD');
        $database_name = env('DB_DATABASE');
        $date_string   = date("Ymd");

        $cmd = "mysqldump --routines -h {$server_name} -u {$username} -p{$password} {$database_name} > " . BACKUP_PATH . "{$date_string}_{$database_name}.sql";

        shell_exec($cmd);
    }

    
}
