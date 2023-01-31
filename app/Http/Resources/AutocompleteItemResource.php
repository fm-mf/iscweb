<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class AutocompleteItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $linkTemplate = $request->target;
        if ($linkTemplate) {
            preg_match('/{.*}/', $linkTemplate, $matches);
            $targetColumn = substr($matches[0], 1, -1);
            $targetColumnValue = $this->getColumnValue($this, $targetColumn);
            $link = preg_replace('/{.*}/', $targetColumnValue, $linkTemplate);
        }

        return [
            'topline' => $this->getLine($this, $request->topline),
            'subline' => $this->getLine($this, $request->subline),
            'link' => $link,
            'image' => $this->person->avatar(),
        ];
    }

    private function getLine($model, $fields)
    {
        if (empty($fields)) {
            return '';
        }

        $values = Collection::make($fields)->map(function ($field) use ($model) {
            return $this->getColumnValue($model, $field);
        });

        return $values->implode(' ');
    }

    private function getColumnValue($model, $field)
    {
        $path = explode('.', $field);
        $cPath = $model;
        foreach ($path as $t) {
            $cPath = $cPath->$t;
        }

        return $cPath;
    }
}
