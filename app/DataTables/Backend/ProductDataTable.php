<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Product;
use Form;
use Yajra\Datatables\Services\DataTable;

class ProductDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.products.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $products = Product::query();
        $profile = \App\Models\Backend\Profile::where('user_id', access()->user()->id)->first();
        if($profile) {
            $products = $products->where('user_id', access()->user()->id); 
        }

        return $this->applyScopes($products);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '15%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> 导出',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    //'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            '商品名称' => ['name' => 'title', 'data' => 'title'],
            '商品id' => ['name' => 'id', 'data' => 'id'],
            #'描述' => ['name' => 'description', 'data' => 'description'],
            '品牌' => ['name' => 'brand_name', 'data' => 'brand_name'],
            '价格' => ['name' => 'price', 'data' => 'price'],
            '地址' => ['name' => 'address', 'data' => 'address'],
            'wechat' => ['name' => 'wechat', 'data' => 'wechat'],
            'QQ' => ['name' => 'qq', 'data' => 'qq'],
            '手机号码' => ['name' => 'phone', 'data' => 'phone'],
            //'用户id' => ['name' => 'user_id', 'data' => 'user_id'],
            '类型' => ['name' => 'type_name', 'data' => 'type_name'],
            //'category_id' => ['name' => 'category_id', 'data' => 'category_id'],
            //'industry_id' => ['name' => 'industry_id', 'data' => 'industry_id'],
            //'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            //'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
            /*
            'contact_name' => ['name' => 'contact_name', 'data' => 'contact_name'],
             */
            '访问数量' => ['name' => 'view_count', 'data' => 'view_count'],
            //'收藏数量' => ['name' => 'collect_count', 'data' => 'collect_count'],
            //'banner_urls' => ['name' => 'banner_urls', 'data' => 'banner_urls'],
            //'status' => ['name' => 'status', 'data' => 'status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'products';
    }
}
