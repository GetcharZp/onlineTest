<?php

namespace app\admin\controller;


class Comment extends Base
{
    // 评论列表
    public function commentList()
    {
        $comments = model('Comment')->with('question', 'user')->order(['create_time' => 'desc'])->paginate(10);
        $viewData = [
            'comments' => $comments
        ];
        $this->assign($viewData);
        return view('commentlist');
    }

    // 查看评论详情
    public function commentRead()
    {
        $commentInfo = model('Comment')->find(input('id'));
        $viewData = [
            'commentInfo' => $commentInfo
        ];
        $this->assign($viewData);
        return view('commentread');
    }

    // 删除评论
    public function commentDel()
    {
        $commentInfo = model('Comment')->find(input('post.id'));
        $result = $commentInfo->delete();
        if ($result) {
            $this->success('删除成功！', 'admin/comment/commentlist');
        }else {
            $this->error('删除失败！');
        }
    }
}
