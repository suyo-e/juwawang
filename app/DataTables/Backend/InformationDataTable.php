<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Information;
use Form;
use Yajra\Datatables\Services\DataTable;

class InformationDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.information.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $information = Information::query();

        return $this->applyScopes($information);
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
            '标题' => ['name' => 'title', 'data' => 'title'],
            '子标题' => ['name' => 'subtitle', 'data' => 'subtitle'],
            #'图片' => ['name' => 'pic_url', 'data' => 'pic_url', 'render' => '"<img src=\""+data+"\" height=\"50\"/>"'],
            '图片' => ['name' => 'pic_url', 'data' => 'pic_url', 'render' => render_image()],
            #'内容' => ['name' => 'content', 'data' => 'content']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'information';
    }
}
