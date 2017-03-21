<?php

/**
 * Created by PhpStorm.
 * User: win
 * Date: 2016/9/9
 * Time: 22:21
 */
class tokenModel extends model
{
    private $table = 'nd_token';

    public function awardToken($uid){
        $token = md5(time() * time() * mt_rand(10000,99999));
        if($this->config->token->isSingleLogin)
            $this->dao->delete()->from($this->table)->where('userID')->eq($uid)->exec();
        $this->dao->delete()->from($this->table)->where('endTime')->lt(time())->exec(); //删除失效的token
        $added = $this->dao->insert($this->table)
            ->set('userID')->eq($uid)
            ->set('token')->eq($token)
            ->set('endTime')->eq(time()+$this->config->token->expire)
            ->exec();
        if($added > 0){
            return $token;
        }else{
            return false;
        }
    }

    public function refresh($token){
        $tokenM = $this->dao->select('*')->from($this->table)
            ->where('token')->eq($token)
            ->fetch();
        if(time() < $tokenM->endTime){
            $this->dao->update($this->table)
                ->set('endTime')->eq(time()+$this->config->token->expire)
                ->where('token')->eq($token)
                ->exec();
            return true;
        }else{
            return false;
        }

    }

    public function getUser($token,$widthRight = false){
        $tokenModel = $this->dao->select('*')->from($this->table)->where('token')->eq($token)->fetch();
        if(!$tokenModel)
            return false;
        if(time() > $tokenModel->endTime)
            return false;
        $user = $this->dao->select('user.*')->from($this->table)->alias('token')
            ->leftJoin('nd_user')->alias('user')->on('token.userID = user.id')
            ->where('token.token')->eq($token)
            ->fetch();
        unset($user->password);
        if($widthRight){
            $right = $this->loadModel('group')->getRight($user->id,$user->admin == 'no');
            if($user->admin == 'no'){
                $user->right = $right;
            }else{
                foreach ($right as $item){
                    $user->right[$item->module][$item->method] = $item->method;
                }
            }
        }
        return $user;

    }

}
