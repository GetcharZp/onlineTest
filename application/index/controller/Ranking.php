<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Ranking extends Controller
{
    public function rankingList()
    {
        $rankings = model('User')->order(['acnum' => 'desc', 'subnum' => 'asc', 'create_time' => 'asc'])->paginate(10);
        $quessubs = model('Quessub')->with('question')->where('user_id', session('user.id'))->order('create_time', 'desc')->limit(5)->select();
        $currentPage = $rankings->currentPage();
        $viewData = [
            'rankings' => $rankings,
            'currentPage' => $currentPage,
            'quessubs' => $quessubs
        ];
        $this->assign($viewData);
        return view('rankinglist');
    }
}
