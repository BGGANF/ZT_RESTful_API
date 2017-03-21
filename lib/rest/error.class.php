<?php
class error
{
	protected $errors;

    public function __construct()
    {
        $this->errors = array();
        $this->errors['ok']           = array('code' => 0,    'name' => '请求成功');
        $this->errors['fail']         = array('code' => 400,  'name' => '请求失败');
        $this->errors['nologin']      = array('code' => 403,  'name' => '未登录系统');

        $this->errors['sysBusy']      = array('code' => 9000, 'name' => '系统繁忙中');
        $this->errors['sysUpgrade']   = array('code' => 9001, 'name' => '系统升级中');

        $this->errors['withoutTS']    = array('code' => 9010, 'name' => '未检测到ts');
        $this->errors['invalidTS']    = array('code' => 9011, 'name' => '无效ts');

        $this->errors['withoutAppID'] = array('code' => 9020, 'name' => '未检测到app_id');
        $this->errors['invalidAppID'] = array('code' => 9021, 'name' => '无效app_id');

        $this->errors['withoutSign']  = array('code' => 9030, 'name' => '未检测到sign');
        $this->errors['invalidSign']  = array('code' => 9031, 'name' => '无效sign');

        $this->errors['withoutCode']  = array('code' => 9040, 'name' => '未检测到code');
        $this->errors['invalidCode']  = array('code' => 9041, 'name' => '无效code');

        $this->errors['getTokenFail']   = array('code' => 9050, 'name' => '获取access_token失败');
        $this->errors['checkTokenFail'] = array('code' => 9051, 'name' => '检验access_token失败');
        $this->errors['withoutToken']   = array('code' => 9052, 'name' => '未检测到accessToken');
        $this->errors['invalidToken']   = array('code' => 9053, 'name' => '无效accessToken');

        $this->errors['withoutOpenID']  = array('code' => 9060, 'name' => '未检测到openID');
        $this->errors['invalidOpenID']  = array('code' => 9061, 'name' => '无效openID');

        $this->errors['withoutClientID']  = array('code' => 9070, 'name' => '未检测到clientID');
        $this->errors['invalidClientID']  = array('code' => 9071, 'name' => '无效clientID');
    }

    public function getCode($type)
    {
        if(isset($this->errors[$type])) return $this->errors[$type]['code'];
        return '';
    }

    public function getName($name)
    {
        if(isset($this->errors[$name])) return $this->errors[$name]['name'];

        return '';
    }
}
