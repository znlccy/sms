<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:01
 * Comment: 角色模型
 */

namespace app\admin\model;

class Role extends BasisModel {

    /* 自动读取和写入时间 */
    protected $autoWriteTimestamp = 'datetime';

    /* 对应的数据表 */
    protected $table = 'tb_role';

    /* 关联的管理员模型 */
    public function admins() {
        return $this->belongsToMany('Admin', 'tb_admin_role', 'admin_id', 'role_id');
    }

    /* 关联的权限模型 */
    public function permissions() {
        return $this->belongsToMany('Permission', 'tb_role_permission', 'permission_id', 'role_id');
    }
}