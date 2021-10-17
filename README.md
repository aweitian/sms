# sms

## install
composer require aweitian/sms

## 单条测试
```
$test = new \Aw\Sms\Ali\Send('LTA...YtG','UImf5c0Pmwl7iCz6xTh0B84YWfdaIm');
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
