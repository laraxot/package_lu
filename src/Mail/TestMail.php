<?php



namespace XRA\LU\Mail;

//use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;

    /**
     * Create a new message instance.
     */
    /*
    public function __construct(Order $order)
    {
        //$this->order = $order;
    }
    */

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('lu::admin.mail.emails.test');
        /*
         return $this->view('emails.orders.shipped')
                    ->with([
                        'orderName' => $this->order->name,
                        'orderPrice' => $this->order->price,
                    ]);
        */
    }
}
