<?php

namespace App\Observers;

use App\Models\OrderDetail;

class OrderDetailObserver
{
    /**
     * Handle the OrderDetail "created" event.
     */
    public function created(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "updated" event.
     */
    public function updated(OrderDetail $orderDetail): void
    {
        if ($orderDetail->isDirty('status')) {
            if ($orderDetail->status == 0) {
                $order = $orderDetail->order;
                $product = $orderDetail->product;
                $order->total_price -= ($orderDetail->quantity * $product->price);
                $order->save();
                if ($orderDetail->order->total_price == 0) {
                    $orderDetail->order->update(['status' => 0]);
                }
            } elseif ($orderDetail->status == 1) {
                // Add the total price based on the quantity and product price
                $order = $orderDetail->order;
                $product = $orderDetail->product;
                $order->total_price += ($orderDetail->quantity * $product->price);
                $order->save();
                if ($orderDetail->order->total_price) {
                    $orderDetail->order->update(['status' => 1]);
                }
            }
        }
    }

    /**
     * Handle the OrderDetail "deleted" event.
     */
    public function deleted(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "restored" event.
     */
    public function restored(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "force deleted" event.
     */
    public function forceDeleted(OrderDetail $orderDetail): void
    {
        //
    }
}
