<?php


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
        $test = new \Aw\Sms\Ali\BatchSend('LTA*******G','UImf************m',__DIR__."/sms.log");
        $test->setPhoneNumber(array('136*******','1519***********'));
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
        $f = $test->send();
        var_dump($test->log);
        $this->assertTrue($f);
    }
}


