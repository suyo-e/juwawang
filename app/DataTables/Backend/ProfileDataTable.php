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
        $is_identities = explode(',', request('is_identities'));
        if($is_identities) {
            $profiles = $profiles->whereIn('is_identity', $is_identities);
        }

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
            '商户名称' => ['name' => 'industry_name', 'data' => 'industry_name'],
            '类型' => ['name' => 'type', 'data' => 'type'],
            '用户id' => ['name' => 'user_id', 'data' => 'user_id'],
            #'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            #'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
            #'industry_id' => ['name' => 'industry_id', 'data' => 'industry_id'],
            #'商户类型' => ['name' => 'category_id', 'data' => 'category_id'],
            '主营业务' => ['name' => 'service', 'data' => 'service'],
            #'identity_urls' => ['name' => 'identity_urls', 'data' => 'identity_urls']
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
