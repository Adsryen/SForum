<?php

declare (strict_types=1);
/**
 * This file is part of zhuchunshu.
 * @link     https://github.com/zhuchunshu
 * @document https://github.com/zhuchunshu/SForum
 * @contact  laravel@88.com
 * @license  https://github.com/zhuchunshu/SForum/blob/master/LICENSE
 */

namespace App\Plugins\User\src\Listener\Pay;

use App\Plugins\Core\src\Lib\Pay\Event\NotifyEvent;
use App\Plugins\Core\src\Models\PayAmountRecord;
use App\Plugins\Core\src\Models\PayOrder;
use App\Plugins\User\src\Models\User;
use App\Plugins\User\src\Models\UsersOption;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class MoneyRecharge implements ListenerInterface
{
    public function listen(): array
    {
        // 返回一个该监听器要监听的事件数组，可以同时监听多个事件
        return [NotifyEvent::class];
    }

    /**
     * @param NotifyEvent $event
     */
    public function process(object $event): void
    {
        //订单id
        $order_id = $event->id;
        if (redis()->sIsMember(env('APP_KEY', 'CodeFec') . ':' . 'user_pay_money_recharge', $order_id)) {
            $order = PayOrder::find($order_id);
            if ($order->status === '支付成功') {
                $user = User::find($order->user_id);
                $option = UsersOption::find($user->options_id);
                $option->money += $order->amount;
                $option->save();
                PayAmountRecord::query()->create(['original' => $option->money, 'cash' => $option->money, 'user_id' => $user->id, 'order_id' => $order->id, 'remark' => '购买:【' . $order->title . '】']);
            }
            redis()->sRem(env('APP_KEY', 'CodeFec') . ':' . 'user_pay_money_recharge', $order_id);
        }
    }
}