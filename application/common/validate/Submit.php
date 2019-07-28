<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/26
 * Time: 18:00
 */

namespace app\common\validate;


use think\Validate;

class Submit extends Validate
{
    protected $rule = [
        'code|提交的代码' => 'require'
    ];

    public function sceneAdd()
    {
        return $this->only(['code']);
    }
}