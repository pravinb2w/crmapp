<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBaseBackup;
use mysqli;

class DataBaseBackupController extends Controller
{
    public function index()
    {
        $data   =   DataBaseBackup::latest()->paginate(10);
        return view("crm.utilities.db-backup.index", compact('data'));
    }
    public function delete($id)
    {
        $data  =    DataBaseBackup::find($id);
        unlink($data->file_name);
        $data->delete();
        return redirect()->back()->with('success','Database Backup Deleted!');
    }

    public function download($id)
    {
        $data  =    DataBaseBackup::find($id);
        return response()->download($data->file_name);
    }

    public function backup()
    {
        $host   = 'localhost';
        $user   = env('DB_USERNAME');
        $pass   = env('DB_PASSWORD');
        $dbname = env('DB_DATABASE');
        $tables = '*';

        error_reporting(0);

        $conn = new mysqli($host, $user, $pass, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($tables == '*'){
            $tables = array();
            $sql = "SHOW TABLES";
            $query = $conn->query($sql);
            while($row = $query->fetch_row()){
                $tables[] = $row[0];
            }
        }
        else{
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }

        $outsql = '';
        foreach ($tables as $table) {

            $sql = "SHOW CREATE TABLE $table";
            $query = $conn->query($sql);
            $row = $query->fetch_row();

            $outsql .= "\n\n" . $row[1] . ";\n\n";

            $sql = "SELECT * FROM $table";
            $query = $conn->query($sql);

            $columnCount = $query->field_count;


            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = $query->fetch_row()) {
                    $outsql .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $outsql .= '"' . $row[$j] . '"';
                        } else {
                            $outsql .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $outsql .= ',';
                        }
                    }
                    $outsql .= ");\n";
                }
            }
            $outsql .= "\n"; 
        }
 
      
        $backup_file_name   = $dbname . '_backup_' . time() . '.sql';
 
        $fileHandler        = fopen($backup_file_name, 'w+');

        fwrite($fileHandler, $outsql);
        fclose($fileHandler);
 
        $save_backups = new DataBaseBackup();
        $save_backups->file_path    =   'public/'.basename($backup_file_name);
        $save_backups->file_name    =   basename($backup_file_name);
        $save_backups->file_size    =   filesize($backup_file_name);
        $save_backups->created_by   =   auth()->user()->name;
        $save_backups->save();
        
        return   $this->storeDatabaseBackup($backup_file_name);
        
    }
    public function storeDatabaseBackup($backup_file_name)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        header('Content-Length:'.filesize($backup_file_name)); 
        ob_clean();
        flush();
        readfile($backup_file_name);
        exec('rm ' . $backup_file_name); 
    }
}

