<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table = 'upload';
    protected $allowedFields = [
        'id',
        'lot_id',
        'file_name', 
        'original_name',
        'upload_date',
        'file_path'
        ];
}
