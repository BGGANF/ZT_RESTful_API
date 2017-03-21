<?php
/**
 * The model file of blog module of ZenTaoPHP.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 * 
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */
?>
<?php
class agModel extends model
{
    public $host;
    public $appID;
    public $token;
    public $encrypt;

    public function __construct(){
        parent::__construct();
        $this->host = $this->config->ag->host;
        $this->appID = $this->config->ag->appID;
        $this->token = $this->config->ag->token;
        $this->encrypt = $this->config->encrypt;
    }

    public function getSign($ts)
    {
        return md5($this->appID . $ts . $this->token . $this->encrypt);
    }

    public function getAuthQuerystirng($ts){
        $str = "?";
        $params = array(
            'ts'=>$ts,
            'appID'=>$this->appID,
            'sign'=>$this->getSign($ts)
        );

        foreach($params as $name =>$value){
            $param[] =$name.'='.$value;
        }
        $str.= implode('&',$param);
        return $str;
    }
    public function sendFile($path){
        $ts = time();
        $url = $this->host.'/v1/upload'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
        $cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array('file' => $cfile);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return $this->getFileUrl($data->content->file);
        }
        return false;
    }
    public function getFileUrl($path){
        $ts = time();
        $str1 = substr($path,0,2);
        if($str1 == './'){
            $length = strlen($path);
            $path =  substr($path,2,($length-2));
        }
        $url = $this->host.'/'.$path;
        return $url;
    }

    public function getVcard($name,$tel,$email,$company,$duty,$uri){
        $ts = time();
        $url = $this->host.'/v1/qr/vcard'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
//        $cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array(
            'vcard_s_name' => $name,
            'vcard_cellul' => $tel,
            'vcard_h_mail' => $email,
            'vcard_compan' => $company,
            'vcard_w_role' => $duty,
            'vcard_h_uri'  => $uri
        );
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return $data->content;
        }
        return false;

    }

    /**
    * 文本二维码
    */    
    public function getQRcode($content,$icon = ''){
        $ts = time();
        $url = $this->host.'/v1/qr/txt'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
        $cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array(
            'content' => $content,
            'icon'    => $icon,
        );
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return $data->content;
        }
        return false;

    }

/********************** 模糊搜索服务 **************************/
    public function search_add($data,$table,$pk){
        $ts = time();
        $url = $this->host.'/v1/searcher/add'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
        //$cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array(
            'content' => $data,
            'table' => $table,
            'pk' => $pk
        );
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return true;
        }
        return false;
    }
    
    public function search_edit($data,$table,$pk){
        $ts = time();
        $url = $this->host.'/v1/searcher/edit'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
        //$cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array(
            'content' => $data,
            'table' => $table,
            'pk' => $pk
        );
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return true;
        }
        return false;
    }
    public function search_delete($table,$pk){
        $ts = time();
        $url = $this->host.'/v1/searcher/delete'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
        $cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array(
            'table' => $table,
            'pk' => $pk
        );
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return true;
        }
        return false;
    }
    public function search($table,$key){
        $ts = time();
        $url = $this->host.'/v1/searcher/search'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 创建一个 CURLFile 对象
//        $cfile = curl_file_create($path);

        // 设置 POST 数据
        $data = array(
            'table'     => $table,
            'key'       => $key,
        );
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output);
        if($data->code == 0){
            return $data->content;
        }
        return false;
    }

/***************************发送邮箱**************************/
    public function sendMail($to,$data){
        $message = sprintf($this->config->mail->template,...$data); //php5.6+
        $ts = time();
        $url = $this->host.'/v1/mailer/send'.$this->getAuthQuerystirng($ts);
        // 创建一个 cURL 句柄
        //
        $ch = curl_init($url);

        // 设置 POST 数据
        $data = array(
            'smtp' =>       $this->config->mail->smtp,
            'from' =>       $this->config->mail->from,
            'password' =>   $this->config->mail->password,
            'to' => $to,
            'subject' =>    $this->config->mail->subject,
            'message' => $message
        );

        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行句柄
        $output = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($output);
        if($data->code == 0){
            return true;
        }
        return false;
    }


}
