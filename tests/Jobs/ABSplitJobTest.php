<?php

namespace Teamtnt\SalesManagement\Tests\Jobs;

use Illuminate\Support\Facades\Bus;

use Teamtnt\SalesManagement\Tests\TestCase;
use Teamtnt\SalesManagement\Jobs\ABSplitJob;

class ABSplitJobTest extends TestCase
{
    /** @test */
    public function it_publishes_a_post()
    {
        Bus::fake();

        ABSplitJob::dispatch(7,1);

        Bus::assertDispatched(ABSplitJob::class, function ($job) use ($nest) {
            return $job->post->id === $post->id;
        });
    }
}