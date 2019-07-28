<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/29
 * Time: 12:27
 */

namespace app\common\validate;


use think\Validate;

class Question extends Validate
{
    protected $rule = [
        'cate_id|问题分类' => 'require',
        'difflavel|难易程度' => 'require',
        'type|问题类型' => 'require',
        'content|问题描述' => 'require',
        'acans|参考答案' => 'require',
        'ans_a|选项A' => 'require',
        'ans_b|选项B' => 'require',
        'ans_c|选项C' => 'require',
        'ans_d|选项D' => 'require'
    ];

    // 问题编辑场景
    public function sceneEdit()
    {
        return $this->only(['content', 'acans']);
    }

    // 判断选择题选项场景
    public function sceneChose()
    {
        return $this->only(['ans_a', 'ans_b', 'ans_c', 'ans_d']);
    }

    // 判断判断题选项场景
    public function sceneJudge()
    {
        return $this->only(['ans_a', 'ans_b']);
    }

    // 问题添加场景
    public function sceneAdd()
    {
        return $this->only(['cate_id', 'difflavel', 'type', 'content', 'acans']);
    }
}