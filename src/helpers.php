<?php

use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Models\ContactTemp;
use Teamtnt\SalesManagement\Models\ContactListContact;
use Teamtnt\SalesManagement\Models\Tag;

if (!function_exists('importTempContactsIntoContacts')) {
    function importTempContactsIntoContacts($batchId)
    {
        \DB::table((new ContactTemp)->getTable())
            ->update(['batch_id' => $batchId]);

        $select = ContactTemp::select(['*']);
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
    function createListFromPipelineStage($contactListId, $taskId, $stageId)
    {
        $select = Lead::select(["contact_id", \DB::raw("{$contactListId} as contact_list_id")])
            ->where('task_id', $taskId)
            ->where('pipeline_stage_id', $stageId);

        $bindings = $select->getBindings();

        $insertQuery = "INSERT into ".(new ContactListContact)->getTable()." (contact_id, contact_list_id) ".$select->toSql();

        \DB::insert($insertQuery, $bindings);
    }
}

/**
 * Get all Tags
 * @return mixed
 */
function getAllTags(): ?string {
    return Tag::all()->toJson();
}
