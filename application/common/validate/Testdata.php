<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/26
 * Time: 13:49
 */

namespace app\common\validate;


use think\Validate;

class Testdata extends Validate
{
    protected $rule = [
        'outdata|测试输出' => 'require'
    ];

    // 测试数据添加
    public function sceneAdd()
    {
        return $this->only(['outdata']);
    }
}