<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;

class AddRules extends Rules
{
    public function isUnique(string $str, string $fields, array $data): bool
    {
        [$table, $column] = explode(".", $fields, 2);

        $model = new \App\Models\LotModel(); // Update with your actual model class

        return $model->where($column, $str)->countAllResults() === 0;
    }
}
