<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class News extends Model
{
    // 使用软删除
    use SoftDelete;

    // 模型关联
    public function admin()
    {
        return $this->belongsTo('Admin', 'admin_id', 'id');
    }

    // 修改新闻
    public function edit($data)
    {
        $validate = new \app\common\validate\News();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $newsInfo = $this->find($data['id']);
        $newsInfo->title = $data['title'];
        $newsInfo->content = $data['content'];
        $result = $newsInfo->save();
        if ($result) {
            return 1;
        } else {
            return '新闻修改失败';
        }
    }

    // 新闻添加
    public function add($data)
    {
        $validate = new \app\common\validate\News();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->save($data);
        if ($result) {
            return 1;
        } else {
            return "新闻插入失败";
        }
    }
}
