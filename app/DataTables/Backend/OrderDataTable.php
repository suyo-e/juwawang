<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Order;
use Form;
use Yajra\Datatables\Services\DataTable;

class OrderDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('product_name', function($order) {
                $product = \App\Models\Backend\Product::find($order->product_id);
                if($product)
                    return $product->title;
                return '';
            })
            ->addColumn('industry_name', function($order) {
                $industry = \App\Models\Backend\Industry::where('user_id', $order->user_id)->first();
                if($industry)
                    return $industry->name;
                return '';
            })
            ->addColumn('province_city_name', function($order) {
                $industry = \App\Models\Backend\Industry::where('user_id', $order->user_id)->first();
                if($industry) {
                    $industry = province_city_name($industry);
                    return $industry->province_city_name;
                }
                return '';
            })
            ->addColumn('action', 'backend.orders.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $orders = Order::query();

        $profile = \App\Models\Backend\Profile::where('user_id', access()->user()->id)->first();
        if($profile) {
            $type = request('type');
            if($type == 'send') {
                $orders = $orders->where('user_id', $profile->user_id);
            }
            else {
                $product_ids = \App\Models\Backend\Product::select('id')->where('user_id', $profile->user_id)->pluck('id');
                $orders = $orders->whereIn('product_id', $product_ids);
            }
        }
        $orders->where('created_at', '<=', date("Y-m-d H:i:s", strtotime('-5 min')))
            ->orderBy('created_at', 'desc')->get();

        return $this->applyScopes($orders);
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
            ->addAction(['width' => '10%'])
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
            '商品id' => ['name' => 'product_id', 'data' => 'product_id'],
            '商品名称' => ['name' => 'product_name', 'data' => 'product_name'],
            '价格' => ['name' => 'price', 'data' => 'price'],
            #'用户id' => ['name' => 'user_id', 'data' => 'user_id'],
            '商家名称' => ['name' => 'industry_name', 'data' => 'industry_name'],
            '联系名称' => ['name' => 'contact_name', 'data' => 'contact_name'],
            '联系电话' => ['name' => 'phone', 'data' => 'phone'],
            '商家所在地' => ['name' => 'province_city_name', 'data' => 'province_city_name'],
            #'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            #'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
            '购买时间' => ['name' => 'created_at', 'data' => 'created_at'],
            '购买数量' => ['name' => 'quantity', 'data' => 'quantity'],
            '备注' => ['name' => 'remark', 'data' => 'remark'],
            #'status' => ['name' => 'status', 'data' => 'status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'orders';
    }
}
