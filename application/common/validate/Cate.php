<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/29
 * Time: 16:58
 */

namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|分类名称' => 'require|unique:cate'
    ];

    // 分类编辑场景
    public function sceneEdit()
    {
        return $this->only(['catename']);
    }

    // 分类添加场景
    public function sceneAdd()
    {
        return $this->only(['catename']);
    }
}