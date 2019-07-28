<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Question extends Model
{
    // 软删除
    use SoftDelete;

    // 关联作者
    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id');
    }

    // 关联类别
    public function cate()
    {
        return $this->belongsTo('Cate', 'cate_id', 'id');
    }

    // 关联提交
    public function quessub()
    {
        return $this->hasMany('Quessub', 'que_id', 'id');
    }

    // 问题编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Question();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        // 判断选择题选项
        if($data['type'] == 1) {
            if (!$validate->scene('chose')->check($data)) {
                return $validate->getError();
            }
        }
        // 判断判断题选项
        if ($data['type'] == 2) {
            if (!$validate->scene('judge')->check($data)) {
                return $validate->getError();
            }
        }
        $questionInfo = $this->where('id', $data['id'])->find();
        $questionInfo->cate_id = $data['cate_id'];
        $questionInfo->difflavel = $data['difflavel'];
        $questionInfo->content = $data['content'];
        if ($data['type'] == 1) {
            $questionInfo->ans_a = $data['ans_a'];
            $questionInfo->ans_b = $data['ans_b'];
            $questionInfo->ans_c = $data['ans_c'];
            $questionInfo->ans_d = $data['ans_d'];
        }
        if ($data['type'] == 2) {
            $questionInfo->ans_a = $data['ans_a'];
            $questionInfo->ans_b = $data['ans_b'];
        }
        $questionInfo->acans = $data['acans'];
        $result = $questionInfo->save();
        if ($result) {
            return 1;
        } else {
            return '问题修改失败，请重试';
        }
    }

    // 添加问题
    public function add($data)
    {
        $validate = new \app\common\validate\Question();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        // 选择题
        if ($data['type'] == 1) {
            if (!$validate->scene('chose')->check($data)) {
                return $validate->getError();
            }
        }
        // 判断题
        if ($data['type'] == 2) {
            if (!$validate->scene('judge')->check($data)) {
                return $validate->getError();
            }
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '问题添加失败';
        }
    }
}
