<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\ProductDataTable;
use App\Http\Requests\Backend;
use App\Http\Requests\Backend\CreateProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest;
use App\Repositories\Backend\ProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('backend.products.index');
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $profile = \App\Models\Backend\Profile::where('user_id', access()->user()->id)->first();
        if($profile) {
            $manu_categories = get_product_categories($profile->type);
            foreach($manu_categories as $row) {
                $categories[$row->id] = $row->display_name;
            }
        }
        else {
            $agent_categories = get_product_categories(\App\Models\Backend\Category::TYPE_AGENT);
            $manu_categories = get_product_categories(\App\Models\Backend\Category::TYPE_MANUFACTURER);

            foreach($manu_categories as $row) {
                $categories['厂商'][$row->id] = $row->display_name;
            }
            foreach($agent_categories as $row) {
                $categories['代理商'][$row->id] = $row->display_name;
            }
        }
        return view('backend.products.create', compact('categories'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = access()->user()->id;

        $profile = \App\Models\Backend\Profile::where('user_id', $input['user_id'])->first();
        if(!$profile) {
            Flash::error('商品发布失败，商户不存在');
            return redirect()->back();
        }

        if(isset($input['banner_urls'])) {
            $input['pic_url'] = $input['banner_urls'][0];
            $input['banner_urls'] = json_encode($input['banner_urls']);
        }

        $product = $this->productRepository->create($input);

        Flash::success('Product saved successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        return view('backend.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }
        $product = province_city_name($product);

        
        $profile = \App\Models\Backend\Profile::where('user_id', access()->user()->id)->first();
        if($profile) {
            $manu_categories = get_product_categories($profile->type);
            foreach($manu_categories as $row) {
                $categories[$row->id] = $row->display_name;
            }
        }
        else {
            $agent_categories = get_product_categories(\App\Models\Backend\Category::TYPE_AGENT);
            $manu_categories = get_product_categories(\App\Models\Backend\Category::TYPE_MANUFACTURER);

            foreach($manu_categories as $row) {
                $categories['厂商'][$row->id] = $row->display_name;
            }
            foreach($agent_categories as $row) {
                $categories['代理商'][$row->id] = $row->display_name;
            }
        }
        return view('backend.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int              $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $input = $request->all();
        if(isset($input['banner_urls'])) {
            $input['pic_url'] = $input['banner_urls'][0];
            $input['banner_urls'] = json_encode($input['banner_urls']);
        }
        /*
        if($request->file('pic_url')) {
            $path = upload($request, 'pic_url');
            $input['pic_url'] = $path;
        }
        else {
            unset($input['pic_url']);
        }
         */

        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('admin.products.index'));
    }
}
