<?php

namespace Teamtnt\SalesManagement\Policies;

class SalesManagementPolicy implements SalesManagementPolicyContract
{
    public function viewDashboard()
    {
        return true;
    }

    public function viewContacts()
    {
        return true;
    }

    public function viewLists()
    {
        return true;
    }

    public function viewPipelines()
    {
        return true;
    }

    public function viewTags()
    {
        return true;
    }

    public function viewDocs()
    {
        return true;
    }

    public function viewCampaigns()
    {
        return true;
    }

    public function viewWorkflows()
    {
        return true;
    }

    public function viewMessages()
    {
        return true;
    }
    public function viewActivities()
    {
        return true;
    }

    public function sendEmails()
    {
        return true;
    }
}
