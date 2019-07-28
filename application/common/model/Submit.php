<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Submit extends Model
{
    // 软删除
    use SoftDelete;

    // 关联用户
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    // 提交代码
    public function add($data)
    {
        $validate = new \app\common\validate\Submit();
        if (!$validate->scene('Add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '代码插入失败';
        }
    }
}
