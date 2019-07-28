<?php

namespace app\admin\controller;


class Admin extends Base
{
    // 管理员列表
    public function adminList()
    {
        $where = [];
        if (input('?status')) {
            $where = [
                'status' => input('status')
            ];
        }
        $admins = model('Admin')->where($where)->order(['is_super'=>'desc', 'create_time'=>'desc'])->paginate(10);
        $viewData = [
            'admins' => $admins
        ];
        $this->assign($viewData);
        return view('adminlist');
    }

    // 修改管理员状态
    public function adminStatus()
    {
        $data = [
            'id' => input('post.id'),
            'status' => input('post.status') ? 0 : 1
        ];
        $result = model('Admin')->isUpdate(true)->save($data);
        if ($result) {
            $this->success('操作成功！', 'admin/admin/adminlist');
        }else {
            $this->error('操作失败！');
        }
    }

    // 管理员添加
    public function adminAdd()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'email' => input('post.email'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->add($data);
            if ($result == 1) {
                $this->success('添加成功！', 'admin/admin/adminlist');
            }else {
                $this->error($result);
            }
        }
        return view('adminadd');
    }

    // 管理员编辑
    public function adminEdit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'is_super' => input('post.is_super')
            ];
            $adminInfo = model('Admin')->find($data['id']);
            $adminInfo->is_super = $data['is_super'];
            $result = $adminInfo->save();
            if ($result == 1) {
                $this->success('修改成功！', 'admin/admin/adminlist');
            }else {
                $this->error($result);
            }
        }
        $adminInfo = model('Admin')->find(input('id'));
        $viewData = [
            'adminInfo' => $adminInfo
        ];
        $this->assign($viewData);
        return view('adminedit');
    }

    // 管理员删除
    public function adminDel()
    {
        $adminInfo = model('Admin')->find(input('post.id'));
        $result = $adminInfo->delete();
        if ($result) {
            $this->success('删除成功！', 'admin/admin/adminlist');
        }else {
            $this->error('删除失败！');
        }
    }
}
