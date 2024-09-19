<?php

namespace App\Filters;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Filters\QueryFilter;
use DB;

class ProductFilter extends QueryFilter
{
    public function title(string $title)
    {
        $words = array_filter(explode(' ', $title));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('title', 'like', "%$word%");
            }
        });
    }

    public function price(float $price)
    {
        $this->builder->where(function (Builder $query) use ($price) {
            $query->where('price', '=', $price);
        });
    }

    public function properties(array $properties): void
    {
        $this->builder->whereIn('id', function (Builder $query) use ($properties) {
            foreach ($properties as $prop => $values) {
                foreach ($values as $val) {
                    $query->selectRaw("
                    product_id
                  FROM
                    rs_products_properties
                  WHERE
                    property_option_id IN (
                      SELECT
                        property_id
                      FROM
                        rs_properties_options
                      WHERE
                        property_id IN (
                          SELECT
                            id
                          FROM
                            rs_properties
                          WHERE
                            title like " . DB::escape($prop) . "
                        )
                        AND property_id IN (
                          SELECT
                            property_id
                          FROM
                            rs_properties_options
                          WHERE
                            text_val = " .  DB::escape($val) . "
                            OR int_val = " .  DB::escape($val) . "
                        )
                    )
                ");
             }
            }
        });
    }
}
