<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:03
 * Comment: 后端基础验证器
 */

namespace app\admin\validate;

use think\Validate;

class BasisValidate extends Validate {

    /* 统一的手机正则表达式验证 */
    protected $regex = '';
}