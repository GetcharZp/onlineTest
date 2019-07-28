<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Problem extends Model
{
    // 软删除
    use SoftDelete;

    // 关联作者
    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id');
    }

    // 关联测试数据
    public function testdata()
    {
        return $this->hasMany('Testdata', 'pro_id', 'id');
    }

    // 添加问题
    public function add($data)
    {
        $validate = new \app\common\validate\Problem();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '问题添加失败';
        }
    }

    // 编辑问题
    public function edit($data)
    {
        $validate = new \app\common\validate\Problem();
        if (!$validate->scene('edit')->check($data)) {
            return $validate-$this->getError();
        }
        $problemInfo = $this->find($data['id']);
        $problemInfo->title = $data['title'];
        $problemInfo->memlimit = $data['memlimit'];
        $problemInfo->timelimit = $data['timelimit'];
        $problemInfo->desc = $data['desc'];
        $problemInfo->indesc = $data['indesc'];
        $problemInfo->outdesc = $data['outdesc'];
        $problemInfo->insample = $data['insample'];
        $problemInfo->outsample = $data['outsample'];
        $problemInfo->hint = $data['hint'];
        $problemInfo->difflavel = $data['difflavel'];
        $result = $problemInfo->save();
        if ($result) {
            return 1;
        } else {
            return '问题修改失败';
        }
    }
}
