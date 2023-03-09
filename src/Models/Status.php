<?php

namespace Teamtnt\SalesManagement\Models;

class Status
{
    const DEAL_STATUS_NEW = 100;
    const DEAL_STATUS_CLOSED = 101;
    const DEAL_STATUS_REJECTED = 102;

    const WORKFLOW_STATUS_NEW = 200;

    const CAMPAIGN_STATUS_NEW = 300;

    public static function getCampaignStatusNames()
    {
        return [
            self::CAMPAIGN_STATUS_NEW => __('New'),
        ];
    }
}
