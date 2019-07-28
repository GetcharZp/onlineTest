<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    // 软删除
    use SoftDelete;

    // 关联问题
    public function question()
    {
        return $this->hasMany('Question', 'cate_id', 'id');
    }

    // 关联提交
    public function quessub()
    {
        return $this->hasMany('Quessub', 'cate_id', 'id');
    }

    // 关联管理员
    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id');
    }

    // 修改分类
    public function edit($data) {
        $validate = new \app\common\validate\Cate();
        if (!$validate->scene('Cate')->check($data)) {
            return $validate->getError();
        }
        $cateInfo = $this->find($data['id']);
        $cateInfo->catename = $data['catename'];
        $result = $cateInfo->save();
        if ($result) {
            return 1;
        } else {
            return '该分类名称与之前的名称相同';
        }
    }

    // 添加分类
    public function add($data)
    {
        $validate = new \app\common\validate\Cate();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '分类添加失败';
        }
    }
}
