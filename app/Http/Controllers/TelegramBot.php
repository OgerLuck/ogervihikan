<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as Users;
use File;

class TelegramBot extends Controller{
    
    public function bot(Request $request){
        $token = "369826729:AAEBzQRWF8KSdxYGwcUZRr4k2lIEHq81nbo";
        $web = "https://api.telegram.org/bot".$token;
        $update = file_get_contents("php://input");
        $updateArray = json_decode($update, TRUE);
        //print_r($updateArray);
        $chatID = $updateArray["message"]["chat"]["id"];
        //file_put_contents("chatID.txt", $request);
        File::put(public_path('/'."chatID.txt"),$request);
        file_get_contents($web."/sendmessage?chat_id=".$chatID."&text=test");
    }

}

?>