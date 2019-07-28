<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/25
 * Time: 14:58
 */

namespace app\common\validate;


use think\Validate;

class News extends Validate
{
    protected $rule = [
        'title|标题' => 'require|max:50',
        'content|正文' => 'require'
    ];

    // 修改新闻
    public function sceneEdit()
    {
        return $this->only(['title', 'content']);
    }

    // 添加新闻
    public function sceneAdd()
    {
        return $this->only(['title', 'content']);
    }
}