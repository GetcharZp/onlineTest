<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    //用户必须登录了，才能进行其他操作
    public function initialize()
    {
        if (!session('?admin.id')) {
            $this->redirect('admin/index/login');
        }
    }
}
