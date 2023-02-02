<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    use HasFactory;

    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
    ];


    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'contact_lists';
        parent::__construct($attributes);
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, config('sales-management.tablePrefix').'contact_list_contacts', 'contact_list_id', 'contact_id');
    }

    public static function getContactListTexts()
    {
        return ContactList::get()->pluck('name', 'id')->toArray();
    }
}
