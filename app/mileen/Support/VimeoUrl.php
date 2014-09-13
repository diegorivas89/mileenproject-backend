<?php 
namespace Mileen\Support;
/**
 * video: http://vimeo.com/82919992
 * embed: //player.vimeo.com/video/82919992
 * thumb: ?
 */
class VimeoUrl
{
	const THUMBNAIL_URL = 'http://img.youtube.com/vi/{video-id}/{thumb-number}.jpg';
	const EMBED_URL = 'http://player.vimeo.com/video/{video-id}';

	protected $videoUrl;

	public static function test($url = '')
	{
		$matches = Array();
		if (preg_match('/vimeo\.com\/([0-9]+)/si', $url, $matches)){
			return true;
		}else{
			return false;
		}
	}

	public static function create($videoUrl = '')
	{
		return new VimeoUrl($videoUrl);
	}

	public function __construct($videoUrl = '')
	{
		$this->videoUrl = $videoUrl;
	}

	public function getVideoId()
	{
		$matches = Array();
		if (preg_match('/vimeo\.com\/([0-9]+)/si', $this->videoUrl, $matches)){
			return $matches[1];
		}else{
			return '';
		}
	}

	public function getUrl()
	{
		return $this->videoUrl;
	}

	public function getEmbedUrl()
	{
		return str_replace('{video-id}', $this->getVideoId(), self::EMBED_URL);
	}

	public function getThumbnailUrl($number = 0)
	{
		return '';
	}
}

?>