<?php

namespace App\Http\Controllers\Api;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Facades\Settings ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class Item
{
    public $topline;
    public $subline;
    public $link;
    public $image;

    public function __construct($topline, $subline, $link, $image = null)
    {
        $this->topline = $topline;
        $this->subline = $subline;
        $this->link = $link;
        $this->image = $image;
    }
}

class AutocompleteController extends Controller
{
    public function exchangeStudents(Request $request)
    {
        $this->authorize('acl', 'users.view');

        $search = ExchangeStudent::findAll()->bySemester(Settings::get('currentSemester'));
        $fullName = strpos($request->input, ' ') !== false
            && in_array('person.first_name', $request->field['columns'])
            && in_array('person.last_name', $request->field['columns']);
        $search = $this->query($search, $request->field, $request->input, $fullName)->limit($request->limit);


        $link = $request->target;
        if ($link) {
            preg_match('/{.*}/', $link, $matches);
            $targetColumn = substr($matches[0], 1, -1);
        }

        $items = [];
        foreach ($search->get() as $student) {
            if ($link) {
                $targetField = $this->getColumnValue($student, $targetColumn);
                $thisLink = preg_replace('/{.*}/', $targetField, $link);
            }
            $items[] = new Item($this->getline($student, $request->topline), $this->getline($student, $request->subline),
                $thisLink, $student->person->avatar());
        }

        return response()->json([
            'items' => $items
        ]);
    }

    public function buddies(Request $request)
    {
        $this->authorize('acl', 'users.view');

        $search = Buddy::findAll();
        $fullName = strpos($request->input, ' ') !== false
            && in_array('person.first_name', $request->field['columns'])
            && in_array('person.last_name', $request->field['columns']);
        $search = $this->query($search, $request->field, $request->input, $fullName)->limit($request->limit);

        $link = $request->target;
        if ($link) {
            preg_match('/{.*}/', $link, $matches);
            $targetColumn = substr($matches[0], 1, -1);
        }

        $items = [];
        foreach ($search->get() as $buddy) {
            if ($link) {
                $targetField = $this->getColumnValue($buddy, $targetColumn);
                $thisLink = preg_replace('/{.*}/', $targetField, $link);
            }
            $items[] = new Item($this->getline($buddy, $request->topline), $this->getline($buddy, $request->subline),
                $thisLink, $buddy->person->avatar());
        }

        return response()->json([
            'items' => $items
        ]);
    }

    private function query($query, $field, $input, $fullName = false)
    {
        $query->where(function($query) use ($field, $input, $fullName) {
            $firstQ = true;
            if($fullName){
                $name = str_replace(' ', '%', $input);
                $table = 'person';
                $col = ['first_name', 'last_name'];
                $query->whereHas($table, function ($query) use ($col, $name) {
                    $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', '%' . $name . '%');
                })->orWhereHas($table, function ($query) use ($col, $name) {
                    $query->where(DB::raw('CONCAT(last_name, " ", first_name)'), 'LIKE', '%' . $name . '%');
                });
            }
            else
            {
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

    private function getline($object, $fields)
    {
        if (!isset($fields)) {
            return "";
        }
        $result = "";
        foreach($fields as $field) {
            $result .= $this->getColumnValue($object, $field) . ' ';
        }
        return substr($result, 0, -1);

    }

    private function getColumnValue($object, $field)
    {
        $path = explode('.', $field);
        $cPath = $object;
        foreach ($path as $t) {
            $cPath = $cPath->$t;
        }
        return $cPath;
    }
}
