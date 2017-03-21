<?php
/**
 * Helper类从baseHelper类继承而来，您可以在这个文件中对其进行扩展。
 * This helper class extends from the baseHelper class, and you can
 * extend it by change this helper.class.php file.
 *
 * @package framework
 *
 * The author disclaims copyright to this source code. In place of
 * a legal notice, here is a blessing:
 * 
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */
include FRAME_ROOT . '/base/helper.class.php';
class helper extends baseHelper
{
    /**
     * Get browser.
     *
     * @access public
     * @return string
     */
    public static function getBrowser()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $agent = $_SERVER["HTTP_USER_AGENT"];
        if(strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0'))
        {
            return "ie";
        }
        else if(strpos($agent, 'Firefox') !== false)
        {
            return "firefox";
        }
        else if(strpos($agent, 'Chrome') !== false)
        {
            return "chrome";
        }
        else if(strpos($agent, 'Opera') !== false)
        {
            return 'opera';
        }
        else if((strpos($agent, 'Chrome') == false) && strpos($agent, 'Safari') !== false)
        {
            return 'safari';
        }
        else
        {
            return 'unknown';
        }
    }

    /**
     * Get browser version.
     *
     * @access public
     * @return string
     */
    public static function getBrowserVersion()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $agent = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if((strpos($agent,'Chrome') == false) && preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/rv:(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else
        {
            return 'unknow';
        }
    }


    /**
     * Get client os from agent info.
     *
     * @static
     * @access public
     * @return string
     */
    public static function getOS()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $osList = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($osList as $regex => $value)
        {
            if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) return $value;
        }

        return 'unknown';
    }

}
