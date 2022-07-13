<?php
    function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
    
        return $ip;
    }    

    function isCurrentIPEmpty(){
        $path = "../Data/currentIP.dat";
        clearstatcache();
        
        if(filesize($path)==0){return true;}
        
        $data = new SplFileObject($path);
        $ip = "";
        while(!($data->eof())){
            $ip = $data->fgets();
        }
        $data = null;

        /* If current ip != last ip --> store current ip */
        if(getUserIp()!=$ip){return true;}
        return false;
    }

    function storeCurrentIP(){
        $path = "../Data/currentIP.dat";
        resetTry("../Data/currentTry.dat");

        $storeIP = fopen($path, 'w');
        $ip = getUserIP();
        fwrite($storeIP, $ip);
        fclose($storeIP);
    }

    function moreThanThreeTimes($path){
        $currentTryFile = fopen($path, 'r');
        $currentTry = "";

        while(!(feof($currentTryFile))){
            $currentTry = fgets($currentTryFile);
        }
        fclose($currentTryFile);
        
        $writeToCurrentFile = fopen($path, 'w');
        if($currentTry < 3){
            ++$currentTry;
            fwrite($writeToCurrentFile, $currentTry);
            fclose($writeToCurrentFile);
            return false;
        } else {
            fwrite($writeToCurrentFile, $currentTry);
            fclose($writeToCurrentFile);
            return true;
        }
    }

    function resetTry($path){
        $TryFile = fopen($path, 'w');
        fwrite($TryFile, 1);
        fclose($TryFile);

        resetLocked();
    }

    function resetLocked(){
        $path = "../Data/currentDateLocked.dat";
        $file = fopen($path, 'w');
        fwrite($file, "");
        fclose($file);
    }

    function lockFile(){
        $current = date('H:i:s');
        $current = date('H:i:s', strtotime($current.'30 seconds'));
        $lockedFile = fopen("../Data/currentDateLocked.dat", 'w');
        fwrite($lockedFile, $current);
        fclose($lockedFile);
    }

    function writeToTemp($array, $path){
        $file = fopen($path, 'w');
        fwrite($file, $array["id"]."-".$array["username"]."-".$array["password"]."-".$array["email"]."-".str_replace("\n", "", $array["sex"])."-".str_replace("\n", "", $array["path"]));
        fclose($file);
    }

    function resetTemp($path){
        $file = fopen($path, 'w');
        fwrite($file, "");
        fclose($file);
    }
?>