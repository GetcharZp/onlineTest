<?php

namespace app\admin\controller;


class Problem extends Base
{
    // 问题列表
    public function problemList()
    {
        $problems = model('Problem')->order('update_time', 'desc')->paginate(10);
        $viewData = [
            'problems' => $problems
        ];
        $this->assign($viewData);
        return view('problemlist');
    }

    // 问题修改
    public function problemEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'title' => input('post.title'),
                'memlimit' => input('post.memlimit'),
                'timelimit' => input('post.timelimit'),
                'difflavel' => input('post.difflavel'),
                'desc' => input('post.desc'),
                'indesc' => input('post.indesc'),
                'outdesc' => input('post.outdesc'),
                'insample' => input('post.insample'),
                'outsample' => input('post.outsample'),
                'hint' => input('post.hint')
            ];
            $result = model('Problem')->edit($data);
            if ($result == 1) {
                $this->success('问题编辑成功', 'admin/problem/problemlist');
            } else {
                $this->error('问题编辑失败');
            }
        }
        $problemInfo = model('Problem')->find(input('id'));
        $viewData = [
            'problemInfo' => $problemInfo
        ];
        $this->assign($viewData);
        return view('problemedit');
    }

    // 问题增加
    public function problemAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'title' => input('post.title'),
                'memlimit' => input('post.memlimit'),
                'timelimit' => input('post.timelimit'),
                'difflavel' => input('post.difflavel'),
                'desc' => input('post.desc'),
                'indesc' => input('post.indesc'),
                'outdesc' => input('post.outdesc'),
                'insample' => input('post.insample'),
                'outsample' => input('post.outsample'),
                'hint' => input('post.hint'),
                'admin_id' => session('admin.id')
            ];
            $result = model('Problem')->add($data);
            if ($result == 1) {
                $this->success('问题插入成功', 'admin/problem/problemlist');
            } else {
                $this->error($result);
            }
        }
        return view('problemadd');
    }

    // 问题删除
    public function problemDel()
    {
        $problemInfo = model('Problem')->with('testdata')->find(input('post.id'));
        $result = $problemInfo->together('testdata')->delete();
        if ($result) {
            $this->success('操作成功！', 'admin/problem/problemlist');
        }else {
            $this->error('操作失败！');
        }
    }

    // 问题详细信息
    public function problemRead()
    {
        $problemInfo = model('Problem')->find(input('id'));
        $viewData = [
            'problemInfo' => $problemInfo
        ];
        $this->assign($viewData);
        return view('problemread');
    }

    // 修改问题的状态
    public function problemStatus()
    {
        $data = [
            'id' => input('post.id'),
            'status' => input('post.status') ? 0 : 1
        ];
        $result = model('Problem')->isUpdate(true)->save($data);
        if ($result) {
            $this->success('操作成功！', 'admin/problem/problemlist');
        }else {
            $this->error('操作失败！');
        }
    }
}
