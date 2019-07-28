<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/28
 * Time: 16:31
 */

namespace app\common\validate;


use think\Validate;

class Quessub extends Validate
{
    protected $rule = [
        'user_ans|答案' => 'require'
    ];

    // 提交场景的答案校验
    public function sceneQuesSubmit()
    {
        return $this->only(['user_ans']);
    }
}