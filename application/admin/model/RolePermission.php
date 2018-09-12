<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:02
 * Comment: 角色权限模型
 */

namespace app\admin\model;

class RolePermission extends BasisModel {

    /* 自动读取和写入时间 */
    protected $autoWriteTimestamp = 'datetime';

    /* 对应的数据表 */
    protected $table = 'tb_role_permission';
}