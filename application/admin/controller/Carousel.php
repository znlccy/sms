<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/12
 * Time: 14:00
 * Comment: 轮播控制器
 */

namespace app\admin\controller;

use think\Request;
use app\admin\model\Carousel as CarouselModel;
use app\admin\validate\Carousel as CarouselValidate;

class Carousel extends BasisController {

    /* 声明轮播模型 */
    protected $carousel_model;

    /* 声明轮播验证器 */
    protected $carousel_validate;

    /* 声明轮播分页器 */
    protected $carousel_page;

    /* 默认构造函数 */
    public function __construct(Request $request = null) {
        parent::__construct($request);
        $this->carousel_model = new CarouselModel();
        $this->carousel_validate = new CarouselValidate();
        $this->carousel_page = config('pagination');
    }

    /* 轮播列表 */
    public function entry() {

        /* 接收数据 */
        $id = input('id');
        $name = input('name');
        $url = input('url');
        $status = input('status');
        $create_start = input('create_start');
        $create_end = input('create_end');
        $update_start = input('update_start');
        $update_end = input('update_end');
        $creator = input('creator');
        $page_size = input('page_size', $this->carousel_page['PAGE_SIZE']);
        $jump_page = input('ump_page', $this->carousel_page['JUMP_PAGE']);

        /* 验证数据 */
        $validate_data = [
            'id'            => $id,
            'name'          => $name,
            'url'           => $url,
            'status'        => $status,
            'create_start'  => $create_start,
            'create_end'    => $create_end,
            'update_start'  => $update_start,
            'update_end'    => $update_end,
            'creator'       => $creator,
            'page_size'     => $page_size,
            'jump_page'     => $jump_page
        ];

        /* 验证结果 */
        $result = $this->carousel_validate->scene('entry')->check($validate_data);
        if (true !== $result) {
            return $this->error('验证出错'. $result);
        }

        //筛选条件
        $condition = [];
        if ($id) {
            $condition['id'] = $id;
        }
        if ($name) {
            $condition['name'] = ['like', '%' . $name . '%'];
        }
        if ($url) {
            $condition['url'] = ['like', '%' . $url . '%'];
        }
        if ($create_start && $create_end) {
            $condition['create_time'] = ['between time', [$create_start, $create_end]];
        }
        if ($update_start && $update_end) {
            $condition['update_time'] = ['between time', [$update_start, $update_end]];
        }
        if ($creator) {
            $condition['creator'] = ['like', '%' . $creator . '%'];
        }
        if ($status) {
            $condition['status'] = $status;
        }

        /* 返回数据 */
        $carousel  = $this->carousel_model
            ->where($condition)
            ->order('id','desc')
            ->paginate($page_size, false, ['page' => $jump_page]);

        if ($carousel) {
            $this->assign('carousel', $carousel);
        }

        return $this->fetch();

    }

    /* 轮播添加 */
    public function add() {

        /* 接收数据 */
        $name = input('post.name', '', 'htmlspecialchars');
        $status = input('post.status');
        $url = input('post.url');
        $picture = input('file.picture');
        // 移动图片到框架应用根目录/public/upload
        if ($picture) {
            $info = $picture->move(ROOT_PATH . 'public' . DS . 'upload');
            if ($info) {
                //成功上传后，获取上传信息
                //输出文件保存路径
                $sub_path = str_replace('\\', '/', $info->getSaveName());
                $picture  = '/images/' . $sub_path;
            }
        }
        $creator = session('admin.name');
        $create_ip = $this->request->ip();

        /* 验证数据 */
        $validate_data = [
            'name'      => $name,
            'status'    => $status,
            'url'       => $url,
            'picture'   => $picture,
            'creator'   => $creator,
            'create_ip' => $create_ip
        ];

        /* 验证结果 */
        $result = $this->carousel_validate->scene('add')->check($validate_data);
        if (true !== $result) {
            return $this->error('验证错误'.$result);
        }

        /* 向数据库中添加数据 */
        $add_result = $this->carousel_model->save($validate_data);
        if ($add_result) {
            return $this->success('添加轮播成功');
        } else {
            return $this->error('添加轮播失败');
        }
    }

    /* 轮播编辑 */
    public function edit() {

    }

    /* 轮播详情 */
    public function detail() {

    }

    /* 轮播删除 */
    public function delete() {

    }
}
