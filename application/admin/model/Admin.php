<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:01
 * Comment: 管理员模型
 */

namespace app\admin\model;

class Admin extends BasisModel {

    /* 自动读取和写入时间 */
    protected $autoWriteTimestamp = 'datetime';

    /* 对应的数据表 */
    protected $table = 'tb_admin';

    /* 关联的角色模型 */
    public function roles() {
        return $this->belongsToMany('Role', 'tb_admin_role', 'role_id', 'admin_id');
    }
}