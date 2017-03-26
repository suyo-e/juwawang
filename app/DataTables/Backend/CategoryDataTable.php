<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Category;
use Form;
use Yajra\Datatables\Services\DataTable;

class CategoryDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.categories.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $categories = Category::query()
            ->orderBy('updated_at', 'desc');

        if(request('type') == 'product') {
            $categories = $categories->whereIn('type', array(
                \App\Models\Backend\Category::TYPE_USER_PRODUCT,
                \App\Models\Backend\Category::TYPE_AGENT_PRODUCT,
                \App\Models\Backend\Category::TYPE_MANUFACTURER_PRODUCT
            ));
        }
        else if(request('type') == 'register') {
            $categories = $categories->whereIn('type', array(
                \App\Models\Backend\Category::TYPE_USER,
                \App\Models\Backend\Category::TYPE_AGENT,
                \App\Models\Backend\Category::TYPE_MANUFACTURER
            ));
        }

        return $this->applyScopes($categories);
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
            '目录编号' => ['name' => 'id', 'data' => 'id'],
            '显示名称' => ['name' => 'display_name', 'data' => 'display_name'],
            '上级id' => ['name' => 'parent_id', 'data' => 'parent_id'],
            '图片' => ['name' => 'pic_url', 'data' => 'pic_url', 'render' => render_image()],
            '类型' => ['name' => 'type', 'data' => 'type', 'render' => render_category_type()],
            //'url' => ['name' => 'url', 'data' => 'url']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categories';
    }
}
