<?php
include dirname(dirname(dirname(realpath(__FILE__)))) . '/core/WeChatApi.class.php';
include dirname(dirname(dirname(realpath(__FILE__)))) . '/core/WeChat.class.php';
//include dirname(realpath(__FILE__)) . '/WxSendBlogWxApi.class.php';

class WxApi extends \core\Wechat
{
	public function responseMsg(){
		parent::responseMsg();
        if( $this->keyword == '推荐' ){

            $blogModel = M('\\model\\BlogModel')->table('bl_blog');
            $blogs = $blogModel->order('post_date desc, view_times desc')->limit('5')->select();

            foreach ($blogs as $key => $value) {
                $blogs[$key]['Title'] = $value['title'];
                $blogs[$key]['Desc'] = htmlspecialchars( $value['intro'] );
                $blogs[$key]['PicUrl'] = 'https://www.bingeblog.xin/' . $value['cover_img'];
                $blogs[$key]['Url'] = "https://www.bingeblog.xin/index.php?p=wechat&m=webWxApi&a=blog&id={$value['id']}& category={$value['c_c_name']}";
//                $blogs[$key]['Url'] = U('wechat/webWxApi/blog', ['id' => $value['id'], 'category' => $value['name']]);
            }

            $this->reNews($blogs);
        }

        if($this->sendType == 'event' && $this->Event == 'subscribe'){
            $this->reText("Bin客欢迎你\n请打开位置共享，仅用于为您查找当前城市下的文章");
        }

		if( !empty( $this->keyword ) ){
            $data = [
                'key'    => '94c1d68f757245a9961c76dbc4949e51',
                'info'   => $this->keyword,
                'userid' => '12345678'
            ];
            $url = 'http://www.tuling123.com/openapi/api';
            $data = $this->CurlRequest($url, json_encode($data), 'json');
            $data = json_decode($data);
            $this->reText($data->text);
		}

	}

    public function getOpenid()
    {
        $json = json_decode(file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxde85cdb773c8050a&secret=14b509f48b4de625c7d9cc20e1bb09ff'));
        if( filemtime('./openid.txt') + 6000 > time() ){
            $access_token = $json['access_token'];
            file_put_contents('./openid.txt', $json['access_token']);
        }else{
            $access_token = file_get_contents('./openid.txt');
        }
        session('access_token', $access_token);
    }

}
