<?php

use Innaco\Repositories\TypeDocumentRepo;
use Innaco\Repositories\TemplateRepo;
use Innaco\Managers\TypeDocumentManager;

class typeDocumentController extends \BaseController {

	protected $typeDocumentRepo;
	protected $templateRepo;

	public function __construct(TypeDocumentRepo $typeDocumentRepo, TemplateRepo $templateRepo)
	{
		$this->typeDocumentRepo = $typeDocumentRepo;
		$this->templateRepo = $templateRepo;
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
			$typeDocuments = $this->typeDocumentRepo->getModel()->search(Input::get('search'))->where('available','=',1)->get();
		}
		else{
			$typeDocuments = $this->typeDocumentRepo->getModel()->where('available','=',1)->paginate(20);
		}
		return View::make('typeDocument.list',compact('typeDocuments'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('typeDocument.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		$data += array('available' => 1);
		$typeDocument = $this->typeDocumentRepo->newTypeDocument();
		$manager = new TypeDocumentManager($typeDocument, $data);
		$manager->save();

		return Redirect::route('type_document.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$template = $this->templateRepo->getModel()->where('typeDocuments_id', '=' ,$id)->get();

		if($template->count()==0){
			$typeDocument = $this->typeDocumentRepo->find($id);
			$typeDocument->delete();
		} else{
			$this->typeDocumentRepo->getModel()->where('id','=',$id)->update(['available' => 0]);
		}

		return Redirect::route('type_document.index');

	}

}
