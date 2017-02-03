<?php

namespace App\Http\Controllers\Api;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Settings\Facade as Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $search = ExchangeStudent::findAll()->bySemester(Settings::get('currentSemester'));
        $search = $this->query($search, $request->field, $request->input)->limit($request->limit);

        $items = [];
        foreach ($search->get() as $student) {
            $items[] = new Item($this->getline($student, $request->topline), $this->getline($student, $request->subline),
                '/partak/exchange-students/' . $student->id_user, $student->person->avatar());
        }

        return response()->json([
            'items' => $items
        ]);
    }

    public function buddies(Request $request)
    {
        $search = Buddy::findAll();
        $search = $this->query($search, $request->field, $request->input)->limit($request->limit);

        $items = [];
        foreach ($search->get() as $buddy) {
            $items[] = new Item($this->getline($buddy, $request->topline), $this->getline($buddy, $request->subline),
                '/partak/exchange-students/' . $buddy->id_user, $buddy->person->avatar());
        }

        return response()->json([
            'items' => $items
        ]);
    }

    private function query($query, $field, $input)
    {
        $query->where(function($query) use ($field, $input) {
            $firstQ = true;
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
            $path = explode('.', $field);
            $cPath = $object;
            foreach ($path as $t) {
                $cPath = $cPath->$t;
            }
            $result .= $cPath . ' ';
        }
        return substr($result, 0, -1);
        $subline = $student->person->user->email;
        $link = url('/partak/exchange-students/' . $student->id_user);

    }
}
