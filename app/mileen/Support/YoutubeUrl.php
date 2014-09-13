<?php
namespace Mileen\Support;
/**
 * video: https://www.youtube.com/watch?v=Bo-qweh7nbQ
 * short: https://youtu.be/Bo-qweh7nbQ
 * embed: https://www.youtube.com/embed/Bo-qweh7nbQ
 * thumb: http://img.youtube.com/vi/Bo-qweh7nbQ/0.jpg
 */
class YoutubeUrl
{
	const THUMBNAIL_URL = 'http://img.youtube.com/vi/{video-id}/{thumb-number}.jpg';
	const EMBED_URL = 'http://www.youtube.com/embed/{video-id}';

	protected $videoUrl;

	public static function create($videoUrl = '')
	{
		return new YoutubeUrl($videoUrl);
	}

	public static function test($url = '')
	{
		$matches = Array();
		if (preg_match('/youtube\.com\/watch\?v=([^&]+)/si', $url, $matches)){
			return true;
		}elseif (preg_match('/youtu\.be\/([^&]+)/si', $url, $matches)){
			return true;
		}else{
			return false;
		}
	}

	public function __construct($videoUrl = '')
	{
		$this->videoUrl = $videoUrl;
	}

	public function getVideoId()
	{
		$matches = Array();
		if (preg_match('/youtube\.com\/watch\?v=([^&]+)/si', $this->videoUrl, $matches)){
			return $matches[1];
		}elseif (preg_match('/youtu\.be\/([^&]+)/si', $this->videoUrl, $matches)){
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
		$thumb = str_replace('{video-id}', $this->getVideoId(), self::THUMBNAIL_URL);
		$thumb = str_replace('{thumb-number}', $number, $thumb);

		return $thumb;
	}
}

?>