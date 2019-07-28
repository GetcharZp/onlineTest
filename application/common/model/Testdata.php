<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Testdata extends Model
{
    // 软删除
    use SoftDelete;

    // 问题关联
    public function problem()
    {
        return $this->belongsTo('Problem', 'pro_id', 'id');
    }

    // 作者关联
    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id');
    }

    // 测试数据的添加
    public function add($data)
    {
        $validate = new \app\common\validate\Testdata();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '数据添加失败请重试';
        }
    }
}
