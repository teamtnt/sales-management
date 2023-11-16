<?php

namespace Teamtnt\SalesManagement\Policies;

interface SalesManagementPolicyContract
{
    public function viewDashboard();

    public function viewContacts();

    public function viewLists();

    public function viewCampaigns();

    public function viewPipelines();

    public function viewTags();

    public function viewDocs();
}
