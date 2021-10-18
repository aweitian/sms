<?php


use Aw\Sms\Ali\SignatureHelper;

class AliTest extends PHPUnit_Framework_TestCase
{
//	/**
//	* A basic test example.
//	*
//	* @return void
//	*/
//	public function testx()
//	{
//		$test = new \Aw\Sms\Ali\Send('LTAI4********HwwtwPzTrF','Ph6JFTLC********GaGUw');
//        $test->setPhoneNumber("136........");
//        $test->setSignName("田AW");
//        $test->setTemplateCode("SMS_125015333");
//        $test->setTemplateParam(array (
//            "code" => "102530",
//        ));
//        $this->assertTrue($test->send());
//        echo $test->log;
//	}

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testb()
    {
//        $test = new \Aw\Sms\Ali\BatchSend('LTA*******G','UImf************m',__DIR__."/sms.log");
//        $test->setPhoneNumber(array('136*******','1519***********'));
//        $test->setSignName(array("田AW","田AW"));
//        $test->setTemplateCode("SMS_125015333");
//        $test->setTemplateParam(array(
//            array(
//                "code" => "123",
//            ),
//            array(
//                "code" => "456",
//            ),
//        ));
//        $f = $test->send();
//        var_dump($test->log);
//        $this->assertTrue($f);
    }

    /**
     *
     * SignStatus
     * 0：审核中。
    1：审核通过。
    2：审核失败，请在返回参数Reason中查看审核失败原因
     *
     *
     * .array(7) {
    ["RequestId"]=>
    string(36) "26D5E39A-A9AE-559B-8D65-487A932DB265"
    ["Message"]=>
    string(2) "OK"
    ["SignStatus"]=>
    int(1)
    ["Code"]=>
    string(2) "OK"
    ["CreateDate"]=>
    string(19) "2021-10-16 11:12:54"
    ["Reason"]=>
    string(15) "无审批备注"
    ["SignName"]=>
    string(13) "十***理"
    }

     */
    public function testQuerySign()
    {
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

    }

    /**
     * TemplateStatus
     * 模板审核状态。取值：

    0：审核中。
    1：审核通过。
    2：审核失败，请在返回参数Reason中查看审核失败原因。
     *
     *
     * TemplateType
     * 短信类型。取值：

    0：验证码。
    1：短信通知。
    2：推广短信。
    3：国际/港澳台消息。
     *
     *
     *
     *
     * ["TemplateCode"]=>
    string(13) "SMS_226400252"
    ["Message"]=>
    string(2) "OK"
    ["RequestId"]=>
    string(36) "3D88FE8D-9463-5A75-9646-D94C94AEB15A"
    ["TemplateContent"]=>
    string(53) "文件${title}已从平台下发，请你登陆签收"
    ["TemplateName"]=>
    string(24) "文件发送短信通知"
    ["TemplateType"]=>
    int(1)
    ["Code"]=>
    string(2) "OK"
    ["CreateDate"]=>
    string(19) "2021-10-16 11:43:00"
    ["Reason"]=>
    string(15) "无审批备注"
    ["TemplateStatus"]=>
    int(1)

     *
     *
     */
    public function testQueryTemplateId()
    {
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
    }
}


