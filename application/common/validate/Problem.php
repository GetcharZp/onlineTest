<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/25
 * Time: 18:00
 */

namespace app\common\validate;


use think\Validate;

class Problem extends Validate
{
    protected $rule = [
        'title|标题' => 'require|max:50|unique:problem',
        'desc|问题描述' => 'require',
        'indesc|输入描述' => 'require',
        'outdesc|输出描述' => 'require',
        'memlimit|内存限制' => 'require|number',
        'timelimit|时间限制' => 'require|number',
        'insample|样例输入' => 'require',
        'outsample|样例输出' => 'require',
        'hint|提示' => 'require',
        'difflavel|困难等级' => 'require'
    ];

    public function sceneAdd()
    {
        return $this->only(['title', 'desc', 'memlimit', 'timelimit']);
    }

    public function sceneEdit()
    {
        return $this->only(['title', 'desc', 'memlimit', 'timelimit'])->remove('title', 'unique');
    }
}