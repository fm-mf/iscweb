<?php

namespace App\Http\Controllers\Api;

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

    public function __construct($topline, $subline, $link)
    {
        $this->topline = $topline;
        $this->subline = $subline;
        $this->link = $link;
    }
}

class AutocompleteController extends Controller
{
    public function exchangeStudents(Request $request)
    {
        $search = ExchangeStudent::findAll()->bySemester(Settings::get('currentSemester'));

        $search = $this->query($search, $request->field, $request->input);

        $items = [];
        foreach ($search->get() as $student) {
            $items[] = new Item($this->getline($student, $request->topline), $this->getline($student, $request->subline), '/partak/exchange-students/' . $student->id_user);
        }

        return response()->json([
            'items' => $items
        ]);
    }

    public function test()
    {
        $reflector = new ReflectionClass('\App\Models\ExchangeStudent');

        dd($reflector);
    }

    private function query($query, $field, $input)
    {
        foreach ($field['columns'] as $column) {
            $comaPos = strrpos($column,'.');
            if ($comaPos) {
                $table = substr("$column", 0, $comaPos);
                $col = substr("$column", $comaPos + 1);
                $query->whereHas($table, function($query) use($col, $input) {
                    $query->where($col, 'LIKE', '%' . $input . '%');
                });
            } else {
                $query->where($column, 'LIKE', '%' . $input . '%');
            }
        }
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
