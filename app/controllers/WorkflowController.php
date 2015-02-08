<?php

use Innaco\Repositories\WorkflowRepo;
use Innaco\Repositories\DocumentRepo;
use Innaco\Repositories\StepDocumentRepo;
use Innaco\Managers\WorkflowManager;

class WorkflowController extends \BaseController {


	protected $workflowRepo;
	protected $documentRepo;
    protected $stepDocumentRepo;

	public function __construct(WorkflowRepo $workflowRepo,DocumentRepo $documentRepo, StepDocumentRepo $stepDocumentRepo)
	{
		$this->workflowRepo = $workflowRepo;
		$this->documentRepo = $documentRepo;
        $this->stepDocumentRepo = $stepDocumentRepo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('search'))
		{
			$documents = $this->documentRepo->search(Input::get('search'));
		}
		else{
			$documents = $this->documentRepo->findAll(true);
		}
		return View::make('workflow.list',compact('documents'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function create()
	{
        $documents_id = Input::get('documents_id');
        $templates_id = Input::get('templates_id');
        //$users_id = \Sentry::getUser()->id;
        $stepDocuments = $this->stepDocumentRepo->getModel()->where('templates_id','=',$templates_id)->orderBy('order','asc')->get();
        foreach ($stepDocuments as $stepDocument)
        {
            if ($stepDocument->task->name == 'Crear'){
                $data = array('documents_id' => intval($documents_id),'states_id' => 3,'stepsdocuments_id' => intval($stepDocument->id),'users_id' => 1);
            }
            else {
                $data = array('documents_id' => intval($documents_id),'states_id' => 1,'stepsdocuments_id' => intval($stepDocument->id),'users_id' => 0);
            }
            $workflow = $this->workflowRepo->newWorkflow();
            $manager = new WorkflowManager($workflow, $data);
            $manager->save();
        }

        return Redirect::route('document.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Input::has('search'))
		{
			$workflow = $this->workflowRepo->search(Input::get('search'));
		}
		else{
            $workflow = $this->workflowRepo->findAll(true);
		}
		return View::make('workflow.show',compact('workflow'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$task = $this->taskRepo->find($id);
		return View::make('task.edit')->with('task',$task);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$task = $this->taskRepo->find($id);
		$data = Input::all();
		$manager = new TaskManager($task, $data);
		$manager->save();

		return Redirect::route('task.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$task = $this->taskRepo->find($id);

		$task->delete();

		return Redirect::route('task.index');

	}


}
