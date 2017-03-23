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
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
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
            '用户id' => ['name' => 'user_id', 'data' => 'user_id'],
            '联系名称' => ['name' => 'contact_name', 'data' => 'contact_name'],
            '联系电话' => ['name' => 'phone', 'data' => 'phone'],
            #'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            #'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
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
