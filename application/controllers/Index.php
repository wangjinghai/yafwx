<?php
/**
 * @name IndexController
 * @author user-20160311lm\administrator
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends Yaf\Controller_Abstract {

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yafnew/index/index/index/name/user-20160311lm\administrator 的时候, 你就会发现不同
     */
	public function indexAction() {
			$nonce = $_GET['nonce'];
			$token = 'wjh';
			$timestamp = $_GET['timestamp'];
			$echostr = $_GET['echostr'];
			$signature = $_GET['signature'];

			//$array = array();
			$array = array($nonce, $timestamp, $token);
			sort($array);

			$str = sha1(implode($array));
			if( $str == $signature && $echostr){
				//
				echo $echostr;
				exit;
			}else{
				$this->reponseMsgAction();
			}
		return false;
	}

	public function reponseMsgAction(){
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		$postObj = simplexml_load_string($postArr);
		if (strtolower($postObj->MsgType) == 'event') {
			if ($postObj->Event == 'subscribe') {
				$toUser = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time = time();
				$msgType = 'text';
				$content = 'welcome follow us' . ' | ' . $postObj->FromUserName . ' | ' . $postObj->ToUserName;
				$template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						</xml>";
				$info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
			}
		}
		if (strtolower($postObj->MsgType) == 'text') {
			switch( trim($postObj->Content)){
				case '预约':
					$content = '您好请点击<a href="http://www.wangjinghai.com/yafnew/index.php/index/form/show">预约表</a>填写预约信息';
					break;
				case '取消':
					$content = '您好请点击<a href="#">取消预约表</a>填写取消信息';
					break;
				default:
					$content = '回复"预约"可进行预约，回复"取消"可取消预约。';
			}
				$toUser = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time = time();
				$msgType = 'text';
				$template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						</xml>";
				$info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
			}
	}
	public function formAction() {

	}
}
