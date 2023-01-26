<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactListContact extends Model
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
        'contact_list_id',
        'contact_id'
    ];


    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'contact_list_contacts';
        parent::__construct($attributes);
    }
}
