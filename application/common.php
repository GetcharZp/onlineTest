<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

// 发送邮件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function email($mailto, $subject, $content)
{
    // 实列化PHPMailer,同时传递true表示启用异常机制
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;                                 // 启用调试
        $mail->isSMTP();                                      // 设置mailer使用简单的邮件传输协议
        $mail->Host = 'smtp.163.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'getcharzhaopan@163.com';                   // SMTP username
        $mail->Password = 'zpmcx09010413';                         // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->CharSet = 'utf-8';

        //Recipients
        $mail->setFrom('getcharzhaopan@163.com', 'GetcharZp');
        $mail->addAddress($mailto);                           // 发送到的目标邮箱
        //Content
        $mail->isHTML(true);                           // Set email format to HTML
        $mail->Subject = $subject;                            // 发送邮箱的标题
        $mail->Body    = $content;                            // 发送邮箱的正文

        return $mail->send();
    }catch (Exception $e) {
        exception($mail->ErrorInfo, 1001);
    }
}

// 调整分页格式
function replace($data)
{
    return str_replace('span', 'a', $data);
}