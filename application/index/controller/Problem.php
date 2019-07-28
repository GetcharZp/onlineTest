<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Problem extends Controller
{

    // 显示问题列表
    public function problemList()
    {
        $problems = model('Problem')->where('status', '=', '1')->paginate(4);
        $viewData = [
            'problems' => $problems
        ];
        $this->assign($viewData);

        return view('problemlist');
    }

    // 通过搜索显示问题列表
    public function problemListKeyword()
    {
        if (input('keyword')) {
            $where[] = ['title', 'like', '%'.input('keyword').'%'];
            $problems = model('Problem')->where($where)->paginate(4);
            $viewData = [
                'problems' => $problems
            ];
            $this->assign($viewData);
        } else {
            $problems = model('Problem')->paginate(4);
            $viewData = [
                'problems' => $problems
            ];
            $this->assign($viewData);
        }

        return view('problemlistkeyword');
    }

    // 问题的详细信息
    public function problemInfo()
    {
        $problemInfo = model('Problem')->with('admin')->where('id', input('id'))->find();
        $commentInfo = model('Comment')->with('user')->where('pro_id', input('id'))->order('create_time', 'desc')->paginate(3);
        $viewData = [
            'problemInfo' => $problemInfo,
            'commentInfo' => $commentInfo
        ];
        $this->assign($viewData);
        return view('probleminfo');
    }

    // 新增评论
    public function problemComment()
    {
        if (request()->isAjax()) {
            $data = [
                'pro_id' => input('post.pro_id'),
                'content' => input('post.comment'),
                'user_id' => session('user.id')
            ];
            $result = model('Comment')->add($data);
            if ($result == 1) {
                $this->success('评论成功');
            } else {
                $this->error($result);
            }
        }
    }

    // 代码提交
    public function problemSubmit()
    {
        $pro_id = input('pro_id');
        $viewData = [
            'pro_id' => $pro_id
        ];
        $this->assign($viewData);
        return view('problemsubmit');
    }
}
