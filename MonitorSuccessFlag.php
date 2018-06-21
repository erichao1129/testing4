<?php
namespace App\Model\ICAS;

use DB;
use Carbon\Carbon;

class MonitorSuccessFlag
{
	private $database = 'takin_compjobs';
	private $crawlingList = 'crawling_list';
	private $crawlAttempt = 'crawl_attempt';
	private $attemptDate;
	private $successFlag;
	
	public function setDatabase($databse)
	{
		$this->database = $database;
	}

	public function setCrawlingList($crawlingList)
	{
		$this->crawlingList = $crawlingList;
	}

	public function setCrawlAttempt($crawlAttempt)
	{
		$this->crawlAttempt = $crawlAttempt;
	}

	public function setAttemptDate($attemptDate)
	{
		$this->attemptDate = (new \DateTime($attemptDate->attempt_date))->format('Y-m-d');
	}

	public function setSuccessFlag($successFlag)
	{
		$this->successFlag = $successFlag->success_flag;
	}

	public function getCrawlingListJoinCrawlAttempt()
	{
		return DB::connection ($this->database)->table($this->crawlingList)->select('crawling_list.competitor_site_code','crawling_list.country','crawling_list.url','crawl_attempt.attempt_date','crawl_attempt.success_flag')->join('crawl_attempt','crawling_list.url','=','crawl_attempt.attempt_url')->get();
	}

	public function isCurrentDate()
	{
		$currentDate = date('Y-m-d');
		return $this->attemptDate == $currentDate;
	}

	public function isCrawlingSuccess()
	{
		return $this->successFlag == 1;
	}

	public function getSiteInfo($input)
	{
		echo $result->competitor_site_code . "_" . $result->country . "_[ " . $result->url . " ] : ";
	}
}
