<?php

namespace App\Imports;

use App\Jobs\SendQueueEmail;
use App\Models\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProjectsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
          $data = array(
            'name' => $row['name'],
            'email'=>$row['email']
          );

         $job = (new SendQueueEmail($data))->delay(now()->addSeconds(2));
         dispatch($job);
         
    }
}
