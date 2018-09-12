<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:53
 * Comment: 轮播模型
 */

namespace app\admin\model;

class Carousel extends BasisModel {

    /* 自动读取和写入时间 */
    protected $autoWriteTimestamp = 'datetime';

    /* 对应的数据表 */
    protected $table = 'tb_carousel';
}