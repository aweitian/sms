<?php


class AliTest extends PHPUnit_Framework_TestCase
{
	/**
	* A basic test example.
	*
	* @return void
	*/
	public function testx()
	{
		$test = new \Aw\Sms\Ali\Send('LTA...YtG','UImf5c0Pmwl7iCz6xTh0B84YWfdaIm');
        $test->setPhoneNumber("136........");
        $test->setSignName("田AW");
        $test->setTemplateCode("SMS_125015333");
        $test->setTemplateParam(array (
            "code" => "102530",
        ));
        $this->assertTrue($test->send());
	}
}


