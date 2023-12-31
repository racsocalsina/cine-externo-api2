<?php


namespace App\Dtos\Mails;


use App\Dtos\Core\BaseDto;
use App\Http\Resources\Purchases\PurchasePaymentDataResource;
use App\Models\Purchases\Purchase;

class EmailPurchaseVoucherDto extends BaseDto
{
    private $purchaseId;
    private $purchaseNumber;
    private $data;

    public static function makeByPurchase(Purchase $purchase)
    {
        $purchase->loadMissing([
            'purchase_voucher', 'purchase_ticket', 'headquarter',
            'payment_gateway_info.payment_gateway_transaction', 'movie.gender',
            'tickets.movie_time_tariff.movie_tariff', 'sweets_sold.product',
            'purchase_ticket', 'purchase_sweet'
        ]);

        $data = json_decode((new PurchasePaymentDataResource($purchase))->toJson());

        return new self(
            $purchase->id,
            $purchase->purchase_voucher ? $purchase->purchase_voucher->purchase_number : '-',
            $data
        );
    }

    private function __construct($purchaseId, $purchaseNumber, $data)
    {
        $this->purchaseId = $purchaseId;
        $this->purchaseNumber = $purchaseNumber;
        $this->data = $data;
    }

    public function getPurchaseNumber()
    {
        return $this->purchaseNumber;
    }

    public function getPurchaseId()
    {
        return $this->purchaseId;
    }

    public function getData()
    {
        return $this->data;
    }

    public function toArray()
    {
        return parent::toArray(); // TODO: Change the autogenerated stub
    }
}

