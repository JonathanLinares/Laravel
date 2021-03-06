<?php namespace Innaco\Managers;

class StepDocumentManager extends BaseManager{

    public function getRules()
    {
        $rules = [
            'templates_id' => 'required',
            'tasks_id' => 'required',
            'groups_id' => 'required',
            'order' => 'required',
            'available' => 'required',
        ];

        return $rules;
    }
}