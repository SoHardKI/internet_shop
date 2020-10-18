<?php


namespace App\Services;

use App\Order;
use App\OrderDetail;
use App\Product;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramService
{
    /**
     * @var string
     */
    private $apiToken;

    /**
     * @var string
     */
    private $chatId;

    /**
     * TelegramService constructor.
     */
    public function __construct()
    {
        $this->apiToken = '1310392812:AAFJPr8JtLAyK3Xawb1sE78PK9fn3LeFDoA';
        $this->chatId = '-1001358732207';
    }

    /**
     * @param Order $order
     * @param array $orderDetails
     */
    public function setOrderInfo(Order $order, array $orderDetails)
    {
        $message = "Новый заказ id - $order->id";
        $message .= "\n Имя клиента - $order->customer_name";
        $message .= "\n Фамилия клиента - $order->customer_second_name";
        $message .= "\n Email клиента - $order->customer_email\n";

        $totalCount = 0;
        /**
         * @var $orderDetail OrderDetail
         */
        foreach ($orderDetails as $orderDetail) {
            $product = Product::find($orderDetail->product->id);
            $message .= "\nКлиент приобрел $product->title в количестве $orderDetail->count, на сумму "
            . $product->price * $orderDetail->count . ' р.';
            $totalCount += $product->price * $orderDetail->count;
        }

        $message .= "\nИтоговая сумма покупки составляет - $totalCount р.";

        Telegram::bot('mybot')->sendMessage(
            [
            'chat_id' => $this->chatId,
            'text' => $message.PHP_EOL,
            'parse_mode' => 'Markdown',
        ]);
    }
}
