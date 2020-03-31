<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Validators\CategoryValidator;
use Illuminate\Support\Facades\Redirect;

/**
 * Class CategoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * @var CategoryValidator
     */
    protected $validator;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $repository
     * @param CategoryValidator $validator
     */
    public function __construct(CategoryRepository $repository, CategoryValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $categoriesTreeData = Category::whereNull('parent_id')->get();
        $categories = $this->repository->paginate(10);
        $parentsList = [];
        $childsList = [];
        for($i = 0; $i < $categories->count(); $i++){
            $category = $categories[$i];
            array_push($parentsList, $this->repository->findWhere(['id' => $category->parent_id])->pluck('category_name')->first());
            $temp = $this->repository->where('parent_id', $category->id)->get();
            if($temp->count() > 0) {
                array_push($childsList, implode('; ', $temp->pluck('category_name')->toArray()));
            } else {
                array_push($childsList, '');
            }
        }
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $categories,
            ]);
        }

        return view('categories.index', compact('categories', 'categoriesTreeData', 'parentsList', 'childsList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name'=>'required'
            ]);

            $category = new Category();
            $category->category_name = $request->get('category_name');
            $category->parent_id = intval($request->get('parent_id'));
            $category->save();

            $response = [
                'message' => 'Category created.',
                'data'    => $category->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return Redirect::to('categories')->with('success', 'Category created.');
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $category,
            ]);
        }

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
        if(isset($id)) {
            $unwantedIdList = $this->repository->select('id')->where('parent_id','=',$id)->get()->toArray();
            array_push($unwantedIdList, $id);
            $parent_list = $this->repository->findWhereNotIn('id', $unwantedIdList)->all();
        } else {
            $parent_list = $this->repository->all();
        }
        return view('categories.create', compact('parent_list', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'category_name'=>'required'
            ]);

            $category = Category::find($id);
            $category->category_name = $request->get('category_name');
            $category->parent_id = intval($request->get('parent_id'));
            $category->update();
            $response = [
                'message' => 'Category updated.',
                'data'    => $category->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return Redirect::to('categories')->with('success', 'Category updated.');
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Category deleted.',
                'deleted' => $deleted,
            ]);
        }
        return Redirect::to('categories')->with('success', 'Category deleted.');
    }

    public function create()
    {
        $parent_list = $this->repository->all();
        return view('categories.create', compact('parent_list'));
    }
}
