<?php

namespace App\Services\Midtrans;

use Midtrans\Config;
use DB;

class Midtrans {
	protected $serverKey;
	protected $isProduction;
	protected $isSanitized;
	protected $is3ds;

	public function __construct()
	{

		$this->_configureMidtrans();
	}

	public function _configureMidtrans()
	{
		$pengaturan = DB::table('pengaturan')->first();
		$this->serverKey = $pengaturan->server_key;
		$this->isProduction = config('midtrans.is_production');
		$this->isSanitized = config('midtrans.is_sanitized');
		$this->is3ds = config('midtrans.is_3ds');
		Config::$serverKey = $this->serverKey;
		Config::$isProduction = $this->isProduction;
		Config::$isSanitized = $this->isSanitized;
		Config::$is3ds = $this->is3ds;
	}
}