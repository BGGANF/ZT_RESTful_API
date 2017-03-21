<?php

/**
 * Created by PhpStorm.
 * User: win
 * Date: 2016/9/9
 * Time: 22:22
 */
class sms extends control
{

    public function send($phone){
        if($this->sms->send($phone) > 0){
            $this->success();
        }else{
            $this->error('',dao::getError());
        }
    }
}