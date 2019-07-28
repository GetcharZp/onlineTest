<?php

namespace app\admin\controller;


class Cate extends Base
{
    // 分类列表
    public function cateList()
    {
        $cates = model('Cate')->order('update_time', 'desc')->paginate(10);
        $viewData = [
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view('catelist');
    }

    // 分类修改
    public function cateEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->edit($data);
            if ($result == 1) {
                $this->success('分类修改成功', 'admin/cate/catelist');
            } else {
                $this->error($result);
            }
        }
        $cateInfo = model('Cate')->find(input('id'));
        $viewData = [
            'cateInfo' => $cateInfo
        ];
        $this->assign($viewData);
        return view('cateedit');
    }

    // 分类增加
    public function cateAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'catename' => input('post.catename'),
                'admin_id' => session('admin.id')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1) {
                $this->success('分类插入成功', 'admin/cate/catelist');
            } else {
                $this->error($result);
            }
        }
        return view('cateadd');
    }

    // 分类删除
    public function cateDel()
    {
        $cateInfo = model('Cate')->with('question')->find(input('post.id'));
        $result = $cateInfo->together('question')->delete();
        if ($result) {
            $this->success('操作成功！', 'admin/cate/catelist');
        }else {
            $this->error('操作失败！');
        }
    }
}
