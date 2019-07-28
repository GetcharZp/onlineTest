<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/22
 * Time: 15:28
 */

namespace app\common\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username|用户名' => 'require|unique:user|max:25',
        'email|邮箱' => 'require|unique:user|email|max:25',
        'password|密码' => 'require|min:6|max:25',
        'conpass|确认密码' => 'require|confirm:password',
        'qq|QQ号' => 'number|max:25',
        'blog|博客' => 'max:50',
        'sign|个性签名' => 'max:1000',
        'oldpass|原密码' => 'require',
        'newpass|新密码' => 'require|min:6|max:25'
    ];

    // 用户注册
    public function sceneRegister()
    {
        return $this->only(['username', 'email', 'password', 'conpass']);
    }

    // 用户注册，发送验证码
    public function sceneVerify()
    {
        return $this->only(['email']);
    }

    // 用户登录
    public function sceneLogin()
    {
        return $this->only(['username', 'password'])->remove('username', 'unique');
    }

    // 忘记密码发送验证码
    public function sceneVerifyforget()
    {
        return $this->only(['email'])->remove('email', 'unique');
    }

    // 修改密码
    public function sceneForget()
    {
        return $this->only(['email', 'password', 'conpass'])
            ->remove('email', 'unique');
    }

    // 修改基本信息
    public function sceneBaseEdit()
    {
        return $this->only(['qq', 'blog', 'sign']);
    }

    // 密码修改
    public function scenePassEdit()
    {
        return $this->only(['password', 'conpass']);
    }

    // 后台修改用户的信息
    public function sceneAdminEdit()
    {
        return $this->only(['newpass']);
    }

    // 后台用户的添加
    public function sceneAdminAdd()
    {
        return $this->only(['username', 'email', 'password']);
    }
}