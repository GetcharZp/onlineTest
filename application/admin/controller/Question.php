<?php

namespace app\admin\controller;


class Question extends Base
{
    // 问题列表
    public function questionList()
    {
        $questions = model('Question')->order('update_time', 'desc')->paginate(10);
        $viewData = [
            'questions' => $questions
        ];
        $this->assign($viewData);
        return view('questionlist');
    }

    // 问题修改
    public function questionEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'cate_id' => input('post.cate_id'),
                'difflavel' => input('post.difflavel'),
                'type' => input('post.type'),
                'content' => input('post.content'),
                'ans_a' => input('post.ans_a'),
                'ans_b' => input('post.ans_b'),
                'ans_c' => input('post.ans_c'),
                'ans_d' => input('post.ans_d'),
                'acans' => input('post.acans')
            ];
            $result = model('Question')->edit($data);
            if ($result == 1) {
                $this->success('问题编辑成功', 'admin/question/questionlist');
            } else {
                $this->error($result);
            }
        }
        $questionInfo = model('Question')->find(input('id'));
        $cates = model('Cate')->select();
        $viewData = [
            'questionInfo' => $questionInfo,
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view('questionedit');
    }

    // 问题增加
    public function questionAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'cate_id' => input('post.cate_id'),
                'difflavel' => input('post.difflavel'),
                'type' => input('post.type'),
                'admin_id' => session('admin.id'),
                'content' => input('post.content'),
                'ans_a' => input('post.ans_a'),
                'ans_b' => input('post.ans_b'),
                'ans_c' => input('post.ans_c'),
                'ans_d' => input('post.ans_d'),
                'acans' => input('post.acans')
            ];
            $result = model('Question')->add($data);
            if ($result == 1) {
                $this->success('问题插入成功', 'admin/question/questionlist');
            } else {
                $this->error($result);
            }
        }
        $cates = model('Cate')->select();
        $viewDate = [
            'cates' => $cates
        ];
        $this->assign($viewDate);
        return view('questionadd');
    }

    // 问题删除
    public function questionDel()
    {
        $questionInfo = model('Question')->with('quessub')->find(input('post.id'));
        $result = $questionInfo->together('quessub')->delete();
        if ($result) {
            $this->success('操作成功！', 'admin/question/questionlist');
        }else {
            $this->error('操作失败！');
        }
    }

    // 问题详细信息
    public function questionRead()
    {
        $questionInfo = model('Question')->find(input('id'));
        $viewData = [
            'questionInfo' => $questionInfo
        ];
        $this->assign($viewData);
        return view('questionread');
    }

    // 修改问题的状态
    public function questionStatus()
    {
        $data = [
            'id' => input('post.id'),
            'status' => input('post.status') ? 0 : 1
        ];
        $result = model('Question')->isUpdate(true)->save($data);
        if ($result) {
            $this->success('操作成功！', 'admin/question/questionlist');
        }else {
            $this->error('操作失败！');
        }
    }
}
