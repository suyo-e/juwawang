<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\CategoryDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateCategoryRequest;
use App\Http\Requests\Backend\UpdateCategoryRequest;
use App\Repositories\Backend\CategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

use App\Models\Backend\Category;

class CategoryController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('backend.categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::select('display_name', 'type', 'id')
            ->where('parent_id', 0)
            ->orderBy('type')
            ->get()
            ->toArray();

        $data = array();
        $data[] = '父节点';
        foreach($categories as $category) {
            switch($category['type']) {
            case Category::TYPE_USER:
                $data['普通用户'][$category['id']] = $category['display_name'];
                break;
            case Category::TYPE_AGENT:
                $data['代理商'][$category['id']] = $category['display_name'];
                break;
            case Category::TYPE_MANUFACTURER:
                $data['厂商'][$category['id']] = $category['display_name'];
                break;
            }
        }
        return view('backend.categories.create', compact('data'));
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        if($input['parent_id'] != 0){
            $parent = Category::find($input['parent_id']);
            $input['type'] = $parent->type;
        }
        if(!$input['url']) {
            $input['url'] = '';
        }
        if($input['pic_url_input'])
        {
            $input['pic_url'] = $input['pic_url_input'];
            unset($input['pic_url_input']);
        }

        $path = upload($request, 'pic_url');
        $input['pic_url'] = $path;

        $category = $this->categoryRepository->create($input);

        Flash::success('Category saved successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);
        $category->updated_at = date("Y-m-d H:i:s");
        $category->save();

        return redirect(route('admin.categories.index'));
/*
        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        return view('backend.categories.show')->with('category', $category);
*/
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }
        
        $categories = Category::select('display_name', 'type', 'id')
            ->where('parent_id', 0)
            ->orderBy('type')
            ->get()
            ->toArray();

        $data = array();
        $data[] = '父节点';
        foreach($categories as $row) {
            switch($row['type']) {
            case Category::TYPE_USER:
                $data['普通用户'][$row['id']] = $row['display_name'];
                break;
            case Category::TYPE_AGENT:
                $data['代理商'][$row['id']] = $row['display_name'];
                break;
            case Category::TYPE_MANUFACTURER:
                $data['厂商'][$row['id']] = $row['display_name'];
                break;
            }
        }
        return view('backend.categories.edit', compact('category', 'data'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }
        $input = $request->all();

        if($request->file('pic_url')) {
            $path = upload($request, 'pic_url');
            $input['pic_url'] = $path;
        }
        else {
            unset($input['pic_url']);
        }
        if($input['pic_url_input'])
        {
            $input['pic_url'] = $input['pic_url_input'];
            unset($input['pic_url_input']);
        }
        if(!$input['url']) {
            $input['url'] = '';
        }

        $category = $this->categoryRepository->update($input, $id);

        Flash::success('Category updated successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('admin.categories.index'));
    }
}
