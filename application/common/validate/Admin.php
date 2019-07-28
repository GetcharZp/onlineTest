<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2019/4/24
 * Time: 16:49
 */

namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username|账号' => 'require|max:25',
        'password|密码' => 'require|min:6|max:25',
        'conpass|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email|unique:admin'
    ];

    // 登录场景
    public function sceneLogin()
    {
        return $this->only(['username', 'password']);
    }

    // 重置密码场景
    public function sceneForget()
    {
        return $this->only(['email'])->remove('email', 'unique');
    }

    // 注册场景
    public function sceneRegister()
    {
        return $this->only(['username', 'password', 'conpass', 'email'])
            ->append('username', 'unique:admin');
    }

    // 添加管理员
    public function sceneAdd()
    {
        return $this->only(['username', 'password', 'email'])
            ->append('username', 'unique:admin');
    }

}