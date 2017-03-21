<?php 
$config->errors = new stdClass();
//通用错误 4xx
$config->errors->permissionFail    = array('message'=>'您没有操作 %s/%s 的权限','code' => 401);
$config->errors->frequently        = array('message'=>'操作频繁，请稍后再试','code'=>402);
$config->errors->vaildFail         = array('message'=>'表单验证不通过','code'=>403);
$config->errors->tokenFail         = array('message'=>'登陆超时，请重新登陆','code'=>404);
$config->errors->uploadToAgFail    = array('message'=>'发生文件到ag失败','code'=>405);
$config->errors->tokenCheckFail    = array('message'=>'Token验证不通过','code'=>406);

//insert update delete faile 6xx
$config->errors->createFail = array('message'=>'创建失败','code'=>6001);
$config->errors->updateFail = array('message'=>'更新失败','code'=>6002);
$config->errors->deleteFail = array('message'=>'删除失败','code'=>6003);
$config->errors->submitFail = array('message'=>'提交失败','code'=>6004);
$config->errors->valueFail  = array('message'=>'必填参数不能为空','code'=>6005);

//其他错误 7xxx
$config->errors->getTokenFail   = array('message' => '请传入token进行验证身份','code' => 7001);
$config->errors->loginFail = array('message'=>'用户名或者密码错误','code'=>7002);

