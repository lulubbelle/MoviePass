<?php
namespace Controllers;

class TestMailController{

    public function Index(){
        $msg = "Testing mail <br> Testing mail <br> Testing mail <br> Testing mail <br> Testing mail <br> lalalalala";

        $msg = wordwrap($msg, 70);

        mail("luli.icasatti@gmail.com", "Hello World ! :)", $msg);

        echo "ok ?";
    }


}


?>