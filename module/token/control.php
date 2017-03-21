<?php

/**
 * Created by PhpStorm.
 * User: win
 * Date: 2016/9/9
 * Time: 22:22
 */
class token extends control
{

    public function refreshToken($token){
        if($this->token->refresh($token) === false){
            return $this->error('tokenCheckFail');
        }else{
            return $this->success();
        }
    }

    public function check($token,$right = 0){
        $user = $this->token->getUser($token,$right == 1?true:false);
        if($user !== false){
            if($user->isExpert == 1){
                $expert = $this->loadModel('expert')->getByUserID($user->id);
                $user->expert = $expert;
            }
            return $this->success($user);
        }else{
            return $this->error('tokenFail');
        }
    }
}
