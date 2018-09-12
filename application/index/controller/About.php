<?php
/**
 * Created by PhpStorm.
 * User: Adminstrator
 * Date: 2018/9/12
 * Time: 22:35
 * Comment: 关于我们控制器
 */

namespace app\index\controller;

class About extends BasicController {

    /* 关于我们界面 */
    public function us() {
        return $this->fetch();
    }

}