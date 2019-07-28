<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    // 软删除
    use SoftDelete;

    // 用户注册
    public function register($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        if ($data['verify'] != session('verify')) {
            return '验证码不正确';
        }
        $data['password'] = md5($data['password']);
        $result = $this->allowField(true)->save($data);
        if ($result) {
            $resultFind = $this->where('username', '=', $data['username'])->find();
            session('user', ['id' => $resultFind['id'], 'username' => $resultFind['username']]);
            return 1;
        } else {
            return '注册失败！';
        }
    }

    // 用户注册发送验证码
    public function verify($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('verify')->check($data)) {
            return $validate->getError();
        }
        $subject = '验证码--GetcharZp';
        $content = '您的验证码为'.session('verify');
        if(email($data['email'], $subject, $content)) {
            return 1;
        } else {
            return '验证码发送失败';
        }
    }

    // 找回密码发送验证码
    public function verifyforget($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('verifyforget')->check($data)) {
            return $validate->getError();
        }
        $result = $this->where($data)->find();
        if (!$result) {
            return '邮箱未注册';
        }
        $subject = '验证码--GetcharZp';
        $content = '您的验证码为'.session('verify');
        if(email($data['email'], $subject, $content)) {
            return 1;
        } else {
            return '验证码发送失败';
        }
    }

    // 用户登录
    public function login($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
        $data['password'] = md5($data['password']);
        $result = $this->where($data)->find();
        if ($result) {
            session('user', ['id' => $result['id'], 'username' => $result['username']]);
            return 1;
        } else {
            $data_email = [];
            $data_email['email'] = $data['username'];
            $data_email['password'] = $data['password'];
            $result = $this->where($data_email)->find();
            if ($result) {
                session('user', ['id' => $result['id'], 'username' => $result['username']]);
                return 1;
            } else {
                return '用户名或密码错误';
            }
        }
    }

    // 忘记密码修改密码
    public function forget($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('forget')->check($data)) {
            return $validate->getError();
        }
        if ($data['verify'] != session('verify')) {
            return '验证码输入不正确';
        }
        $userInfo = $this->where('email', $data['email'])->find();
        if ($userInfo['password'] == md5($data['password'])) {
            return '新密码与原密码相同，请重试';
        }
        $userInfo->password = md5($data['password']);
        $result =$userInfo->save();
        if ($result) {
            return 1;
        } else {
            return '密码修改失败';
        }
    }

    // 修改用户的基本信息
    public function baseEdit($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('baseEdit')->check($data)) {
            return $validate->getError();
        }
        $userInfo = $this->where('email', $data['email'])->find();
        $userInfo->qq = $data['qq'];
        $userInfo->blog = $data['blog'];
        $userInfo->sign = $data['sign'];
        $result = $userInfo->save();
        if ($result) {
            return 1;
        } else {
            return '信息修改失败';
        }
    }

    // 密码修改
    public function passEdit($data)
    {
        $userInfo = $this->where('id', $data['id'])->find();
        if ($userInfo['password'] != md5($data['oldpass'])) {
            return '原密码输入不正确';
        }
        $validate = new \app\common\validate\User();
        if (!$validate->scene('passEdit')->check($data)) {
            return $validate->getError();
        }
        if ($userInfo['password'] == md5($data['password'])) {
            return '您的原密码与新密码一致';
        }
        $userInfo->password = md5($data['password']);
        $result = $userInfo->save();
        if ($result) {
            return 1;
        } else {
            return '密码修改失败!';
        }
    }

    // 后台修改用户信息
    public function adminEdit($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('adminEdit')->check($data)) {
            return $validate->getError();
        }
        $userInfo = $this->find($data['id']);
        $userInfo->password = md5($data['newpass']);
        $result = $userInfo->save();
        if ($result) {
            return 1;
        }else {
            return '新密码与原密码一样';
        }
    }

    // 后台添加用户
    public function adminAdd($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('adminAdd')->check($data)) {
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
