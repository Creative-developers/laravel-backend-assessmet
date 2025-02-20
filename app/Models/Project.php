<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'entity_id');
    }

    public function scopeWithFilters(Builder $query, $filters)
    {
        if ($filters) {
            foreach ($filters as $filter => $value) {
                if (is_array($value)) {
                    foreach ($value as $operator => $val) {
                        $this->applyFilter($query, $filter, $operator, $val);
                    }
                } else {
                    $this->applyFilter($query, $filter, '=', $value);
                }
            }
        }
    }

    private function applyFilter(Builder $query, $filter, $operator, $value)
    {
        if (in_array($filter, $this->getFillable())) {

            //apply 'like' operator
            if ($operator === 'like') {
                $query->where($filter, 'like', '%' . $value . '%');
            } else {
                // Apply basic operators ( '=', '>', '<')
                $query->where($filter, $operator, $value);
            }
        } else {
            $attribute = Attribute::where('name', $filter)->first();
            if ($attribute) {
                //apply 'like' operator

                if ($operator === 'like') {
                    $query->whereHas('attributeValues', function ($q) use ($attribute, $value) {
                        $q->where('attribute_id', $attribute->id)->where('value', 'like', '%' . $value . '%');
                    });
                } else {
                    // Apply basic operators ('=', '>', '<')
                    $query->whereHas('attributeValues', function ($q) use ($attribute, $operator, $value) {
                        if (is_numeric($value)) {
                            $value =  (int) $value;
                        }
                        $q->where('attribute_id', $attribute->id)->where('value', $operator, $value);
                    });
                }
            }
        }
    }
}
