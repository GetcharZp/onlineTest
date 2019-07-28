<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    // 软删除
    use SoftDelete;

    // 关联评论者
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    // 关联问题
    public function problem()
    {
        return $this->belongsTo('Problem', 'pro_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo('question', 'pro_id', 'id');
    }

    // 添加评论
    public function add($data)
    {
        $validate = new \app\common\validate\Comment();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '评论添加失败';
        }
    }
}
