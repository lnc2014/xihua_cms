<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

//通用 0000-0099
$config['response']['0000'] = "操作成功";
$config['response']['0001'] = "未知错误";
$config['response']['0002'] = "内部错误";
$config['response']['0003'] = "非法参数";
$config['response']['0004'] = "非法请求";
$config['response']['0005'] = "未登录";
$config['response']['0006'] = "已存在记录";
$config['response']['0007'] = "类型错误";
$config['response']['0008'] = "无数据";
$config['response']['0009'] = "权限错误";
$config['response']['0010'] = "用户不存在";
$config['response']['0011'] = "不存在该用户手机";
$config['response']['0012'] = "验证码错误";
$config['response']['0013'] = "验证码已过期";
$config['response']['0014'] = "司机端，用户不存在";
$config['response']['0015'] = "发送短信失败";
$config['response']['0016'] = "验证错误";
$config['response']['0017'] = "电话号码已经存在";
$config['response']['0018'] = '请勿频繁请求';
$config['response']['0019'] = '通过起终点经纬度获取地址失败';

//用户 0100-0199
$config['response']['0100'] = '您的号码尚未备案，请联系车队管理员处理';
$config['response']['0101'] = '发送验证码失败，请重试';
$config['response']['0102'] = '注册失败，请重试';
$config['response']['0103'] = '原密码输入错误';
$config['response']['0104'] = '订单状态不正确';
$config['response']['0105'] = '单位名字已经存在';
$config['response']['0106'] = '订单已经发车，不能取消';
$config['response']['0107'] = '本系统仅提供给车队方使用';
$config['response']['0108'] = '登录失败, 请确认用户和密码是否正确,并且帐号未停用';
$config['response']['0109'] = '两次密码输入不一致';

//订单 0200-0299
$config['response']['0200'] = '订单不存在';
$config['response']['0201'] = '无权查看该订单';
$config['response']['0202'] = '不能分配相同的车辆';
$config['response']['0203'] = '订单用车时间与现有车辆排车记录有冲突';
$config['response']['0204'] = '获取车队ID失败, 请联系系统管理员处理';
$config['response']['0205'] = '该订单的往返省市区数据有误, 请重新录入起始站点';
$config['response']['0206'] = '该订单已经外派';
$config['response']['0207'] = '订单状态不合理';
$config['response']['0208'] = '订单已经发车，不能取消外放';
$config['response']['0209'] = '订单已经发车，不能外放';
$config['response']['0210'] = '该订单已经接单';
$config['response']['0211'] = '补录订单车辆总数不能为0';
$config['response']['0212'] = '订单信息不存在';
$config['response']['0213'] = '订单结束的时间不能早于发车时间';
$config['response']['0214'] = '此订单尚未到达结束时间';
$config['response']['0215'] = '此订单尚未开发票';
$config['response']['0216'] = '此订单尚未全额支付';
$config['response']['0217'] = '该订单为定期结算订单，目前尚未支付，无法标记完成！';
//车队 0300-0399
$config['response']['0300'] = '该车牌号已存在，请重新填写';
$config['response']['0301'] = '该gps设备号是无效的，请重新填写';
$config['response']['0302'] = '该gps账号无效，请重新填写';
$config['response']['0303'] = '该gps设备号已存在，请重新填写';
$config['response']['0304'] = '车队信息中没有关联gps账号';
$config['response']['0305'] = '车队报价格不正确';
$config['response']['0306'] = '车队不存在';
$config['response']['0307'] = '城市已存在';
$config['response']['0308'] = '车队信息不存在';

//司机 0400-0499
$config['response']['0400'] = '该手机号已存在其他车队中, 请更换其他号码';
$config['response']['0401'] = '司机信息不存在';
$config['response']['0402'] = '司机请假时间校验不正确';
$config['response']['0403'] = '司机请假信息不存在';
$config['response']['0404'] = '此时间已有请假信息，请先检查是否重复';
$config['response']['0405'] = '该时间已安排司机出车，请先修改排车信息';
//排车 0500-0599
$config['response']['0500'] = '司机该时间段已有排车，请更换其他司机。';
$config['response']['0501'] = '排车数据校验不正确';
$config['response']['0502'] = '司机在订单时间内不能提供服务，请更换其他司机。';
$config['response']['0503'] = '车辆在订单时间段内不可用！';
$config['response']['0504'] = '司机有重复排车，请修改后提交。';
//企业注册 0600-0699
$config['response']['0600'] = '密码格式不正确';
$config['response']['0601'] = '企业注册失败';
$config['response']['0602'] = '手机号码已经注册';
$config['response']['0603'] = '企业名字已经存在';
$config['response']['0604'] = '支付校验失败，请选择要支付的订单';
$config['response']['0605'] = '企业超出预支额度，请先支付欠款';
$config['response']['0606'] = '账号无法登陆，请与客服联系，客服电话：4008520084';
//车辆信息 0700-0799
$config['response']['0700'] = '车辆信息不存在';
$config['response']['0701'] = '车辆送修的时间不能大于车辆取车的时间';
$config['response']['0702'] = '车辆送检的时间不能大于车辆取车的时间';
$config['response']['0703'] = '此时间已有送修信息，请先检查是否重复';
$config['response']['0704'] = '此时间已有送检信息，请先检查是否重复';
$config['response']['0705'] = '该时间段已有排车，如需保修，请先取消排车。';
$config['response']['0706'] = '该时间段已有排车，如需年审/年检，请先取消排车。';
$config['response']['0707'] = '送修时间重复，请先检查是否重复';
$config['response']['0708'] = '送检时间重复，请先检查是否重复';
//财务信息 0800-0899
$config['response']['0800'] = '车队尚未绑定支付宝';