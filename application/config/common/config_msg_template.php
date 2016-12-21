<?php
/**
 * 消息模板配置
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
/***************消息模板错误编码******************/
//通用错误码 0000-0099
$config['response']['0000'] = "success";
$config['response']['0001'] = "unknown error";
$config['response']['0002'] = "internal error";
$config['response']['0003'] = "illegal parameter";
$config['response']['0004'] = "illegal request";
//模板信息错误 00100-0199
$config['response']['0010'] = "模板调用方法不存在";
$config['response']['0011'] = "模板配置错误";
$config['response']['0012'] = "短信发送失败";
$config['response']['0013'] = "手机号码为空，短信发送失败";
$config['response']['0014'] = "短信内容为空，短信发送失败";
$config['response']['0015'] = "微信内容为空，微信发送失败";


/***************消息模板编号******************/
//嘟嘟巴士消息模板 0000-0099
$config['template_id']['0000'] = "offer_price";//嘟嘟车队报价短信
$config['template_id']['0001'] = "has_offer_price_by_order";//嘟嘟车队报价成功，发送报价成功短信,按单结算短信
$config['template_id']['0002'] = "has_offer_price_by_month";//嘟嘟车队报价成功，发送报价成功短信,按定期结算短信
$config['template_id']['0003'] = "reg_enterprise";//用户注册完成后，给注册用户发送短信【嘟嘟巴士】
$config['template_id']['0004'] = "car_for_user";//车队排车后，下单用户收到短信【嘟嘟巴士】
$config['template_id']['0005'] = "send_settlement";// 每个月25日上午9:00，计算企业B端客户上个月（上月25日到本月25日下单但未支付的订单），短信通知企业B端的超级管理员。
$config['template_id']['0006'] = "arrange_car_for_user";//计调排车之后给嘟嘟的用户发送排车的信息
$config['template_id']['0007'] = "cancel_order_to_user";//计调取消订单之后给嘟嘟用户发送信息

//车务管家消息模板 0100-0199
$config['template_id']['0100'] = "offer_price";
$config['template_id']['0101'] = "enterprise_pay_order";//企业支付成功之后，给嘟嘟车队发送微信
$config['template_id']['0102'] = "enterprise_cancel_order";//企业取消订单之后，给嘟嘟车队发送微信
$config['template_id']['0103'] = "enterprise_cancel_order_to_order";//企业取消订单之后，如果接单方已经接单，给接单车队计调发送微信
$config['template_id']['0104'] = "enterprise_cancel_order_to_driver";// 企业取消订单之后，如果接单方已经排车要给司机发送信息
$config['template_id']['0105'] = "enterprise_finance";//企业定期结算的订单给嘟嘟车队财务发送支付信息
$config['template_id']['0106'] = "user_scan_code";//扫码下单的用户给下单车队的计调发送信息
$config['template_id']['0107'] = "user_wx_cancle";//微信端用户取消订单给接单车队计调发送信息
$config['template_id']['0108'] = "user_wx_cancle_to_sub";//微信端用户取消订单给放单车队计调发送信息
$config['template_id']['0109'] = "user_wx_cancle_to_driver";//微信端用户取消订单给接单车队和放单车队计调发送信息
$config['template_id']['0110'] = "user_pay";//微信端用户支付定金给车队计调发送微信和短信
$config['template_id']['0111'] = "user_pay_last";//微信端用户支付尾款给车队计调发送微信和短信
$config['template_id']['0112'] = "arrange_driver_last_pay";//给司机安排车辆之后还有尾款尚未支付
$config['template_id']['0113'] = "arrange_driver";//给司机安排车辆之后,尾款已经支付
$config['template_id']['0114'] = "user_wx_cancle_to_sub2";//用户取消订单之后给接单计调发送微信
$config['template_id']['0115'] = "dudu_cancle_order";//后台嘟嘟车队取消订单，触发给接单车队计调的信息【分状态：该模板为已经接单的模板】
$config['template_id']['0116'] = "out_order";//后台嘟嘟车队外放订单，给接单计调发送信息
$config['template_id']['0117'] = "warn_msg";//预警消息模板


//5U用车消息模板 0200-0299
$config['template_id']['0200'] = "offer_price";
$config['template_id']['0201'] = "cancel_order_to_user";//计调取消订单之后给5U用户发送信息