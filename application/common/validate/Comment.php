<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/26
 * Time: 16:18
 */

namespace app\common\validate;


use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'content|评论' => 'require'
    ];

    // 添加评论
    public function sceneAdd()
    {
        return $this->only(['content']);
    }
}