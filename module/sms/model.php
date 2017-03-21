<?php

class smsModel extends model
{
    private $table = 'nd_sms';
    public function send($phone){
        if(!validater::checkPhone($phone)){
            dao::$errors['phone'][] = '请输入正确的手机格式';
            return false;
        }
        $code = mt_rand(100000,999999);

        //todo : 发送短信。。。
        $data = new stdClass();
        $data->code = $code;
        $data->onject = $phone;
        $data->type = 'member';
        $data->createTime = time();
        $data->fails = 0;
        return $this->dao->insert($this->table)->data($data)->exec();
    }

    public function check(){
        return true;
        $data = fixer::input('post')->get();
        $codeInfo = $this->dao->select('*')->from($this->table)->where('id')->eq($data->codeID)
            ->fetch();
        if($codeInfo->createTime + $this->config->sms->outTime < time()){
            dao::$errors['code'][] = '验证码已过期';
            return false;
        }
        if($codeInfo->fails > 10){
            dao::$errors['code'][] = '操作频繁';
            return false;
        }
        if($data->account == $codeInfo->object && $data->code == $codeInfo->code){
            $this->dao->update($this->table)->set('fails')->eq('fails + 1')->exec();
            dao::$errors['code'][] = '验证码不正确';
            return true;
        }else{
            return false;
        }
    }

}