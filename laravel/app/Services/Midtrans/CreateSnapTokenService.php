<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
	protected $billing;

	public function __construct($billing)
	{
		parent::__construct();

		$this->billing = $billing;
	}

	public function getSnapToken()
	{
		$params['transaction_details'] = [
				'order_id' => $this->billing->id,
				'gross_amount' => $this->billing->total,
			];
		$params['item_details'] = [];

		$add = [
			'id' => 1,
			'price' => $this->billing->biaya,
			'quantity' => 1,
			'name' => $this->billing->kelas
		];
		array_push($params['item_details'],$add);

		$add = [
			'id' => 2,
			'price' => $this->billing->kode_unik,
			'quantity' => 1,
			'name' => 'Kode Unik'
		];
		array_push($params['item_details'],$add);

		$params['customer_details'] = [
			'first_name' => $this->billing->nama,
			'email' => $this->billing->email,
			'phone' => $this->billing->no_hp,
		];

		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}
