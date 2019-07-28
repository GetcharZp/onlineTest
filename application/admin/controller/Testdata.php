<?php

namespace app\admin\controller;


class Testdata extends Base
{
    // 测试数据列表
    public function testdataList()
    {
        $testdatas = model('Testdata')->order('update_time', 'desc')->paginate(10);
        $viewData = [
            'testdatas' => $testdatas
        ];
        $this->assign($viewData);
        return view('testdatalist');
    }

    // 测试数据添加
    public function testdataAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'pro_id' => input('post.pro_id'),
                'admin_id' => input('post.admin_id'),
                'indata' => input('post.indata'),
                'outdata' => input('post.outdata')
            ];
            $result = model('Testdata')->add($data);
            if ($result == 1) {
                $this->success('测试数据添加成功', 'admin/problem/problemlist');
            } else {
                $this->error($result);
            }
        }
        $problemInfo = model('Problem')->with('admin')->find(input('id'));
        $viewData = [
            'problemInfo' => $problemInfo
        ];
        $this->assign($viewData);
        return view('testdataadd');
    }

    // 测试数据删除
    public function testdataDel()
    {
        $testdataInfo = model('Testdata')->find(input('post.id'));
        $result = $testdataInfo->delete();
        if ($result) {
            $this->success('操作成功！', 'admin/testdata/testdatalist');
        }else {
            $this->error('操作失败！');
        }
    }

    // 测试数据修改
    public function testdataEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'indata' => input('post.indata'),
                'outdata' => input('post.outdata')
            ];
            $testdataInfo = model('Testdata')->find($data['id']);
            $testdataInfo->indata = $data['indata'];
            $testdataInfo->outdata = $data['outdata'];
            $result = $testdataInfo->save();
            if ($result) {
                $this->success('测试数据修改成功', 'admin/testdata/testdatalist');
            } else {
                $this->error('测试数据修改失败');
            }
        }
        $testdataInfo = model('Testdata')->find(input('id'));
        $viewData = [
            'testdataInfo' => $testdataInfo
        ];
        $this->assign($viewData);
        return view('testdataedit');
    }

    // 测试数据详情
    public function testdataRead()
    {
        $testdataInfo = model('Testdata')->find(input('id'));
        $viewData = [
            'testdataInfo' => $testdataInfo
        ];
        $this->assign($viewData);
        return view('testdataread');
    }
}
