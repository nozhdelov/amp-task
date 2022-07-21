<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Jobs\CollectPrices;
use Illuminate\Support\Facades\Mail;

class SendNotificationsTest extends TestCase {

    public function test_TheSendNotificationsJobShouldSendEmails() {

        Mail::fake();

        $notificationUser = \App\Models\NotificationUser::factory()->create();
        $notifications = \App\Models\NotificationSetting::factory()
                ->count(1)
                ->for($notificationUser, 'user')
                ->create();

        $pricePoint = \App\Models\PricePoint::factory()->create();

        \App\Jobs\SendNotifications::dispatchNow($pricePoint, $notifications);

        Mail::assertSent(\App\Mail\PriceChanged::class);
    }

}
