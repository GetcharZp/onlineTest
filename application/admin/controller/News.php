<?php

namespace app\admin\controller;


class News extends Base
{
    // 新闻列表
    public function newsList()
    {
        $newss = model('News')->order('update_time', 'desc')->paginate(10);
        $viewData = [
            'newss' => $newss
        ];
        $this->assign($viewData);
        return view('newslist');
    }

    // 新闻删除
    public function newsDel()
    {
        $news = model('News')->find(input('post.id'));
        $result = $news->delete();
        if ($result) {
            $this->success('删除成功', 'admin/news/newslist');
        } else {
            $this->error('删除失败');
        }
    }

    // 查看新闻详情
    public function newsRead()
    {
        $newsInfo = model('News')->find(input('id'));
        $viewData = [
            'newsInfo' => $newsInfo
        ];
        $this->assign($viewData);
        return view('newsread');
    }

    // 新闻编辑
    public function newsEdit()
    {
        if (request()->isAjax())
        {
            $data = [
                'id' => input('post.id'),
                'title' => input('post.title'),
                'content' => input('post.content')
            ];
            $result = model('News')->edit($data);
            if ($result == 1) {
                $this->success('新闻编辑成功', 'admin/news/newslist');
            } else {
                $this->error($result);
            }
        }
        $newsInfo = model('News')->find(input('id'));
        $viewData = [
            'newsInfo' => $newsInfo
        ];
        $this->assign($viewData);
        return view('newsedit');
    }

    // 新闻添加
    public function newsAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'title' => input('post.title'),
                'content' => input('post.content'),
                'admin_id' => session('admin.id')
            ];
            $result = model('News')->add($data);
            if ($result == 1) {
                $this->success('新闻添加成功', 'admin/news/newslist');
            } else {
                $this->error($result);
            }
        }
        return view('newsadd');
    }
}
