<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Profile;
use Form;
use Yajra\Datatables\Services\DataTable;

class ProfileDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.profiles.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $profiles = Profile::query();

        return $this->applyScopes($profiles);
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
            'type' => ['name' => 'type', 'data' => 'type'],
            'user_id' => ['name' => 'user_id', 'data' => 'user_id'],
            'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
            'industry_id' => ['name' => 'industry_id', 'data' => 'industry_id'],
            'industry_name' => ['name' => 'industry_name', 'data' => 'industry_name'],
            'category_id' => ['name' => 'category_id', 'data' => 'category_id'],
            'service' => ['name' => 'service', 'data' => 'service'],
            'identity_urls' => ['name' => 'identity_urls', 'data' => 'identity_urls']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'profiles';
    }
}
