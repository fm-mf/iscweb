<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Facades\Settings;
use App\Http\Resources\AutocompleteItemCollection;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    public function exchangeStudents(Request $request)
    {
        $this->authorize('acl', 'users.view');

        $filter = (object) $this->validateRequest($request);

        $search = ExchangeStudent::includingDegreeStudents()->withAll();
        if (!$filter->allSemesters) {
            $search = $search->bySemester(Settings::get('currentSemester'));
        }

        $fullName = strpos($filter->input, ' ') !== false
            && in_array('person.first_name', $filter->field['columns'])
            && in_array('person.last_name', $filter->field['columns']);

        $search = $this->query($search, $filter->field, $filter->input, $fullName)
            ->limit($filter->limit);

        return new AutocompleteItemCollection($search->get());
    }

    public function buddies(Request $request)
    {
        $this->authorize('acl', 'users.view');

        $filter = (object) $this->validateRequest($request);

        $search = Buddy::findAll();
        $fullName = strpos($filter->input, ' ') !== false
            && in_array('person.first_name', $filter->field['columns'])
            && in_array('person.last_name', $filter->field['columns']);

        $search = $this->query($search, $filter->field, $filter->input, $fullName)
            ->limit($filter->limit);

        return new AutocompleteItemCollection($search->get());
    }

    private function query($query, $field, $input, $fullName = false)
    {
        $query->where(function ($query) use ($field, $input, $fullName) {
            $firstQ = true;
            if ($fullName) {
                $name = str_replace(' ', '%', $input);
                $table = 'person';
                $query->whereHas($table, function ($query) use ($name) {
                    $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $name . '%');
                })->orWhereHas($table, function ($query) use ($name) {
                    $query->where(DB::raw('CONCAT(last_name, " ", first_name)'), 'LIKE', '%' . $name . '%');
                });
            } else {
                foreach ($field['columns'] as $column) {
                    $commaPos = strrpos($column, '.');
                    if ($commaPos) {
                        $table = substr($column, 0, $commaPos);
                        $col = substr($column, $commaPos + 1);
                        if ($firstQ) {
                            $firstQ = false;
                            $query->whereHas($table, function ($query) use ($col, $input) {
                                $query->where($col, 'LIKE', '%' . $input . '%');
                            });
                        } else {
                            $query->orWhereHas($table, function ($query) use ($col, $input) {
                                $query->where($col, 'LIKE', '%' . $input . '%');
                            });
                        }
                    } else {
                        if ($firstQ) {
                            $firstQ = false;
                            $query->where($column, 'LIKE', '%' . $input . '%');
                        } else {
                            $query->orWhere($column, 'LIKE', '%' . $input . '%');
                        }
                    }
                }
            }
        });
        return $query;
    }

    private function validateRequest(Request $req)
    {
        return $req->validate([
            'field' => 'array',
            'input' => 'string',
            'topline' => 'array',
            'subline' => 'array',
            'limit' => 'integer',
            'target' => 'string',
            'allSemesters' => 'bool|nullable'
        ]);
    }
}
