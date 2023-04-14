<?php

use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\ContactListContact;
use Teamtnt\SalesManagement\Models\ContactTemp;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Models\Tag;

if (!function_exists('importTempContactsIntoContacts')) {
    function importTempContactsIntoContacts($batchId)
    {
        \DB::table((new ContactTemp)->getTable())
            ->update(['batch_id' => $batchId]);

        $select   = ContactTemp::select(['*']);
        $bindings = $select->getBindings();

        $insertQuery = "INSERT into ".(new Contact)->getTable()." ".$select->toSql();

        \DB::insert($insertQuery, $bindings);
    }
}

if (!function_exists('importContactsToContactList')) {
    function importContactsToContactList($contactListId, $batchId)
    {
        $select = Contact::select(["id", \DB::raw("{$contactListId} as contact_list_id")])
            ->where('batch_id', $batchId);

        $bindings = $select->getBindings();

        $insertQuery = "INSERT into ".(new ContactListContact)->getTable()." (contact_id, contact_list_id) ".$select->toSql();

        \DB::insert($insertQuery, $bindings);
    }
}

if (!function_exists('createListFromPipelineStage')) {
    function createListFromPipelineStage($contactListId, $campaignId, $stageId)
    {
        $select = Lead::select(["contact_id", \DB::raw("{$contactListId} as contact_list_id")])
            ->where('campaign_id', $campaignId)
            ->where('pipeline_stage_id', $stageId);

        $bindings = $select->getBindings();

        $insertQuery = "INSERT into ".(new ContactListContact)->getTable()." (contact_id, contact_list_id) ".$select->toSql();

        \DB::insert($insertQuery, $bindings);
    }
}

if (!function_exists('createLeadsFromContacts')) {

    function createLeadsFromContacts($campaign_id, $pipeline_id, $contact_list_id)
    {
        $leadsTableName = (new Lead)->getTable();

        $select = ContactListContact::select(["contact_id as id", \DB::raw("{$campaign_id} as campaign_id"), \DB::raw("{$pipeline_id} as pipeline_id"), \DB::raw("0 as pipeline_stage_id")])
            ->where('contact_list_id', $contact_list_id);
        $bindings = $select->getBindings();

        $insertQuery = "INSERT into {$leadsTableName} (contact_id, campaign_id, pipeline_id, pipeline_stage_id) "
        .$select->toSql();

        \DB::insert($insertQuery, $bindings);
    }
}

if (!function_exists('isValidEmail')) {
    function isValidEmail($email)
    {
        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Check if the email is valid
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('getAllTags')) {
    function getAllTags():  ? string
    {
        return Tag::all()->toJson();
    }
}
