<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:02
 * Comment: 权限模型
 */

namespace app\admin\model;

class Permission extends BasisModel {

    /* 自动读取和写入时间 */
    protected $autoWriteTimestamp = 'datetime';

    /* 对应的数据表 */
    protected $table = 'tb_permission';

    /* 关联的模型 */
    public function roles() {
        return $this->belongsToMany('Role', 'tb_role_permission', 'role_id', 'permission_id');
    }

}