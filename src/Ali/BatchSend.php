<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/22
 * Time: 13:30
 */

namespace Aw\Sms\Ali;


class BatchSend
{
    protected $accessKeyId;
    protected $accessKeySecret;

    protected $params = array();
    public $msg;
    public $log = null;

    public function __construct($accessKeyId, $accessKeySecret, $log_path = null)
    {
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
        $this->log = $log_path;
    }


    public function debug()
    {
        ini_set("display_errors", "on"); // 显示错误提示，仅用于测试时排查问题
        set_time_limit(0); // 防止脚本超时，仅用于测试使用，生产环境请按实际情况设置
        header("Content-Type: text/plain; charset=utf-8"); // 输出为utf-8的文本格式，仅用于测试
    }



    /**
     * array(4) {
    ["Message"]=>
    string(2) "OK"
    ["RequestId"]=>
    string(36) "93BBFEAA-77BD-52F8-B79B-1980F80494A6"
    ["BizId"]=>
    string(20) "782411834445583228^0"
    ["Code"]=>
    string(2) "OK"
    }

     * 批量发送短信
     */
    public function send() {

        $params = $this->params;

        // *** 需用户填写部分 ***
        // fixme 必填：是否启用https
        $security = false;

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = $this->accessKeyId;
        $accessKeySecret = $this->accessKeySecret;

//        // fixme 必填: 待发送手机号。支持JSON格式的批量调用，批量上限为100个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
//        $params["PhoneNumberJson"] = array(
//            '13641898273',
//            '15190248729'
//        );
//
//        // fixme 必填: 短信签名，支持不同的号码发送不同的短信签名，每个签名都应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
//        $params["SignNameJson"] = array(
//            "田AW",
//            "田AW",
//        );

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_125015333";

//        // fixme 必填: 模板中的变量替换JSON串,如模板内容为"亲爱的${name},您的验证码为${code}"时,此处的值为
//        // 友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        $params["TemplateParamJson"] = array(
            array(
                "code" => "102530",
            ),
            array(
                "code" => "456",
            ),
        );

        // todo 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        // $params["SmsUpExtendCodeJson"] = json_encode(array("90997","90998"));


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        $params["TemplateParamJson"]  = json_encode($params["TemplateParamJson"], JSON_UNESCAPED_UNICODE);
        $params["SignNameJson"] = json_encode($params["SignNameJson"], JSON_UNESCAPED_UNICODE);
        $params["PhoneNumberJson"] = json_encode($params["PhoneNumberJson"], JSON_UNESCAPED_UNICODE);

        if(!empty($params["SmsUpExtendCodeJson"]) && is_array($params["SmsUpExtendCodeJson"])) {
            $params["SmsUpExtendCodeJson"] = json_encode($params["SmsUpExtendCodeJson"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendBatchSms",
                "Version" => "2017-05-25",
            )),
            $security
        );
        if (!is_null($this->log) && file_exists($this->log)) {
            file_put_contents($this->log, $content, FILE_APPEND);
        } else {
            $this->log = $content;
        }
        $this->msg = $content['Message'];
        return $content['Code'] == "OK";
    }


    /**
     * PhoneNumbers = 17000000000
     * SignName = 短信签名
     * TemplateCode = SMS_0000001
     * TemplateParam = [
     *      "code" => "12345"
     *      "product" => "阿里通信"
     * ]
     * SmsUpExtendCode   1234567   上行短信扩展码
     * @param array $params
     */
    public function setParams(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * array(
        "1500000000",
        "1500000001",
    )
     * @param $no
     * @return $this
     */
    public function setPhoneNumber(array $no)
    {
        $this->params["PhoneNumberJson"] = $no;
        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setSignName($name)
    {
        $this->params["SignNameJson"] = $name;
        return $this;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setTemplateCode($code)
    {
        $this->params["TemplateCode"] = $code;
        return $this;
    }

    /**
     * @param array $param
     * @return $this
     */
    public function setTemplateParam(array $param)
    {
        $this->params["TemplateParamJson"] = $param;
        return $this;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setSmsUpExtendCode($code)
    {
        $this->params["SmsUpExtendCode"] = $code;
        return $this;
    }
}