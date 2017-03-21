<?php

/**
 * Created by PhpStorm.
 * User: win
 * Date: 2016/9/10
 * Time: 11:24
 */
class groupModel extends model
{
    public function getRight($userID,$isNotAdmin = false){
        if($isNotAdmin) return $this->config->rights->member;
        $right = $this->dao->select('priv.*')->from('nd_usergroup')->alias('ug')
            ->leftJoin('nd_grouppriv')->alias('priv')->on('ug.group = priv.group')
            ->where('userID')->eq($userID)
            ->fetchAll();
        if($right === false)
        {
            return array();
        }
        return $right;
    }
}
