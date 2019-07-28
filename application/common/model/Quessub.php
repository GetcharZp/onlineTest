<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Quessub extends Model
{
    // 软删除
    use SoftDelete;

    // 关联问题
    public function question()
    {
        return $this->belongsTo('Question', 'que_id', 'id');
    }

    // 关联提交者
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    // 关联类别
    public function cate()
    {
        return $this->belongsTo('Cate', 'cate_id', 'id');
    }

    // 答案的提交
    public function quesSubmit($data)
    {
        $validate = new \app\common\validate\Quessub();
        if (!$validate->scene('quesSubmit')->check($data)) {
            return $validate->getError();
        }
        $acans = model('Question')->where('id', $data['que_id'])->find();
        $userInfo = model('User')->where('id', $data['user_id'])->find();
        $userInfo->setInc('subnum');
        if ($acans['acans'] == $data['user_ans']) {
            $data['judge_status'] = 2; // Accept
            $submits = model('Quessub')->where('user_id', $data['user_id'])->where('que_id', $data['que_id'])->column('judge_status');
            if (!in_array(2, $submits)) {
                $userInfo->setInc('acnum');
            }
        } else {
            $data['judge_status'] = 3; // Wrong Answer
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '答案提交失败，请重试';
        }
    }
}
