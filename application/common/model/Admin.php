<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    use SoftDelete;

    // 管理员登录
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
        $data['password'] = md5($data['password']);
        $result = $this->where($data)->find();
        if ($result) {
            if ($result['status'] == 0) {
                return '此账户已被禁用！';
            }
            $sessionData = [
                'id' => $result['id'],
                'username' => $result['username'],
                'is_super' => $result['is_super']
            ];
            session('admin', $sessionData);
            return 1;
        } else {
            return '用户名或密码错误';
        }
    }

    // 管理员忘记密码
    public function forget($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('forget')->check($data)) {
            return $validate->getError();
        }
        $result = $this->where($data)->find();
        $subject = '重置密码验证码--GetcharZp';
        $content = '您的验证码是：'. session('code');
        if ($result && email($data['email'], $subject, $content)) {
            return 1;
        }else {
            return '没有此注册邮箱！';
        }
    }

    // 管理员注册
    public function register($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        $data['password'] = md5($data['password']);
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '注册失败！';
        }
    }

    // 管理员添加
    public function add($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $data['password'] = md5($data['password']);
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        }else {
            return '添加失败！';
        }
    }
}
