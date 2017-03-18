<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Industry;
use Form;
use Yajra\Datatables\Services\DataTable;

class IndustryDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.industries.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $industries = Industry::query();

        return $this->applyScopes($industries);
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
            'display_name' => ['name' => 'display_name', 'data' => 'display_name'],
            'user_id' => ['name' => 'user_id', 'data' => 'user_id'],
            'avatar' => ['name' => 'avatar', 'data' => 'avatar'],
            'pic_urls' => ['name' => 'pic_urls', 'data' => 'pic_urls'],
            'identity_urls' => ['name' => 'identity_urls', 'data' => 'identity_urls'],
            'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
            'address' => ['name' => 'address', 'data' => 'address'],
            'service' => ['name' => 'service', 'data' => 'service'],
            'description' => ['name' => 'description', 'data' => 'description']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'industries';
    }
}
