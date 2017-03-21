<?php
/**
 * Control类从baseControl类继承而来，每个模块的control对象从control类集成。
 * 您可以对baseControl类进行扩展，扩展的逻辑可以定义在这个文件中。
 *
 * This control class extends from the baseControl class and extened by every module's control. 
 * You can extend the baseControl class by change this file.
 *
 * @package framework
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */
include FRAME_ROOT . '/base/control.class.php';
class control extends baseControl
{
    protected $errors;
    public function __construct($moduleName, $methodName, $appName)
    {
        parent::__construct($moduleName, $methodName, $appName);

        //todo : 权限验证
//        if(!isset($this->config->rights->guest[strtolower($this->moduleName)][strtolower($this->methodName)])){
//            $gets = fixer::input(strtolower($_SERVER['REQUEST_METHOD']))->get();
//            if(!isset($gets->token)){
//                header("Content-type: application/json; charset=utf-8");
//                echo json_encode($this->error('getTokenFail'));
//                exit();
//            }
//            $token = $gets->token;
//            $tokenModel = $this->loadModel('token');
//            $user = $tokenModel->getUser($token,true);
//            if(!$user){
//                header("Content-type: application/json; charset=utf-8");
//                echo json_encode($this->error('tokenFail',array($this->moduleName,$this->methodName)));
//                exit();
//
//            }
//            if($user->admin != 'super' && !isset($user->right[strtolower($this->moduleName)][strtolower($this->methodName)])){
//                header("Content-type: application/json; charset=utf-8");
//                echo json_encode($this->error('permissionFail',array($this->moduleName,$this->methodName)));
//                exit();
//            }
//            $tokenModel->refresh($token);
//            $this->app->user = $user;
//        }
    }

    public function error($key,$params = array(),$resetCode = null){
        $error = $this->config->errors->{$key};
        if($key == 'vaildFail'){
            $error['validation'] = $params;
        }elseif(count($params) > 0){
            $error['message'] = sprintf($error['message'],...$params); //php5.6+
        }

        if($resetCode != null){
            $error['code'] = $resetCode;
        }
        return $error;
    }

    public function success($content = '',$message = '请求成功'){
        $data = array('code'=>0);
        $data['message'] = $message;
        $data['content'] = $content;
        return $data;
    }

}
