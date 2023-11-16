<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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
        'firstname',
        'lastname',
        'phone',
        'email',
        'job_title',
        'salutation',
        'company_name',
        'vat',
        'url',
        'company_email',
        'address',
        'postal',
        'city',
        'country',
        'uuid',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix') . 'contacts';
        parent::__construct($attributes);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, config('sales-management.tablePrefix') . 'contact_tag');
    }

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
