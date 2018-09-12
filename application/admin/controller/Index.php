<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 18:17
 * Comment: 首页控制器
 */

namespace app\admin\controller;

class Index extends BasisController {

    /* 后台首页 */
    public function index() {
        return $this->fetch();
    }
}