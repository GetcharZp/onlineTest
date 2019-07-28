<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Quessub extends Controller
{
    // 查看提交列表
    public function quessubList()
    {
        $quessubs = model('Quessub')->order('create_time', 'desc')->paginate(10);
        $flag = 0;
        $viewData = [
            'quessubs' => $quessubs,
            'flag' => $flag
        ];
        $this->assign($viewData);
        return view('quessublist');
    }
}
