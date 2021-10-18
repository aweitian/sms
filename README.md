# sms

## install
composer require aweitian/sms

## 单条测试
```
$test = new \Aw\Sms\Ali\Send('LTA...YtG','UImf5*******aIm');
$test->setPhoneNumber("136........");
$test->setSignName("田AW");
$test->setTemplateCode("SMS_125015333");
$test->setTemplateParam(array (
  "code" => "102530",
));
$this->assertTrue($test->send());
```

## 批量测试
```
$test = new \Aw\Sms\Ali\BatchSend('LTAIj*****tG','UImf5c0Pmw******WfdaIm',__DIR__."/sms.log");
$test->setPhoneNumber(array('136******','1*******29'));
$test->setSignName(array("田AW","田AW"));
$test->setTemplateCode("SMS_125015333");
$test->setTemplateParam(array(
    array(
        "code" => "123",
    ),
    array(
        "code" => "456",
    ),
));
$this->assertTrue($test->send());
var_dump($test->log);
```

### 签名查询
```php
$params = array(
    'SignName' => '十***理'
);

$helper = new SignatureHelper();

// 此处可能会抛出异常，注意catch
$content = $helper->request(
    'LTAI*****jnaqE',
    'SuO*********KVFgIxi',
    "dysmsapi.aliyuncs.com",
    array_merge($params, array(
        "RegionId" => "cn-hangzhou",
        "Action" => "QuerySmsSign",
        "Version" => "2017-05-25",
    )),
    true
);
var_dump($content);
```
<pre>
"RequestId"=> "26D5E39A-A9AE-559B-8D65-487A932DB265"
"Message"=> "OK"
"SignStatus"=> 1 0：审核中。
                 1：审核通过。
                 2：审核失败，请在返回参数Reason中查看审核失败原因
"Code"=> "OK"
"CreateDate"=> "2021-10-16 11:12:54"
"Reason"=> "无审批备注"
"SignName"=> "十***理"
</pre>

### 模板查询
```php
$params = array(
    'TemplateCode' => 'SMS_226400252'
);

$helper = new SignatureHelper();

// 此处可能会抛出异常，注意catch
$content = $helper->request(
    'LT***naqE',
    'SuOU********VFgIxi',
    "dysmsapi.aliyuncs.com",
    array_merge($params, array(
        "RegionId" => "cn-hangzhou",
        "Action" => "QuerySmsTemplate",
        "Version" => "2017-05-25",
    )),
    true
);
var_dump($content);

```

<pre>
"TemplateCode" => "SMS_226400252"
"Message"=> "OK"
"RequestId"=> "3D88FE8D-9463-5A75-9646-D94C94AEB15A"
"TemplateContent"=> "文件${title}已从平台下发，请你登陆签收"
"TemplateName"=> "文件发送短信通知"
"TemplateType"=> 1 0：验证码。
                   1：短信通知。
                   2：推广短信。
                   3：国际/港澳台消息。

"Code"=> "OK"
"CreateDate"=> "2021-10-16 11:43:00"
"Reason"=> "无审批备注"
"TemplateStatus"=> 1  0：审核中。
                      1：审核通过。
                      2：审核失败，请在返回参数Reason中查看审核失败原因。
</pre>
