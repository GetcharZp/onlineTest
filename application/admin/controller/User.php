<?php

namespace app\admin\controller;


class User extends Base
{
    // 用户列表
    public function userList()
    {
        $users = model('User')->order('create_time', 'desc')->paginate(10);
        $viewData = [
            'users' => $users
        ];
        $this->assign($viewData);
        return view('userlist');
    }

    // 用户编辑
    public function userEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'oldpass' => input('post.oldpass'),
                'newpass' => input('post.newpass')
            ];
            $result = model('User')->adminEdit($data);
            if ($result == 1) {
                $this->success('编辑成功！', 'admin/user/userlist');
            }else {
                $this->error($result);
            }
        }
        $userInfo = model('User')->find(input('id'));
        $viewData = [
            'userInfo' => $userInfo
        ];
        $this->assign($viewData);
        return view('useredit');
    }

    // 用户删除
    public function userDel()
    {
        $userInfo = model('User')->find(input('post.id'));
        $result = $userInfo->delete();
        if ($result) {
            $this->success('操作成功！', 'admin/user/userlist');
        }else {
            $this->error('操作失败！');
        }
    }

    // 用户添加
    public function userAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'email' => input('post.email'),
            ];
            $result = model('User')->adminAdd($data);
            if ($result == 1) {
                $this->success('添加成功！', 'admin/user/userlist');
            }else {
                $this->error($result);
            }
        }
        return view('useradd');
    }
}
