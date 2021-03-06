<?php namespace Innaco\Managers;

class TypeDocumentManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'name' => 'required|unique:type_documents',
            'available' => 'required'
        ];

        return $rules;
    }
}