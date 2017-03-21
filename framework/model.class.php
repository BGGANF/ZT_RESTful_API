<?php
/**
 * model类从baseModel类继承而来，每个模块的model对象从model类集成。
 * 您可以对baseModel类进行扩展，扩展的逻辑可以定义在这个文件中。
 *
 * This model class extends from the baseModel class and extened by every module's model. 
 * You can extend the baseModel class by change this file.
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
include FRAME_ROOT . '/base/model.class.php';
class model extends baseModel
{
    public $host;
    public $appID;
    public $token;

    public function __construct($appName = '')
    {
        parent::__construct($appName);

        $this->host  = $this->config->ag->host;
        $this->appID = $this->config->ag->appID;
        $this->token = $this->config->ag->token;
        $this->encrypt = $this->config->encrypt;

        $this->app->loadClass('rest');
        $this->rest = new rest();
    }

    protected function getUrl($url)
    {
        $ts   = time();
        $sign = md5($this->appID . $ts . $this->token. $this->encrypt);
        return $this->host . $url . '?ts=' . $ts . '&sign=' . $sign . '&appID=' . $this->appID;
    }

}
