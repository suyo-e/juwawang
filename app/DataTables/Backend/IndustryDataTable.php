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
        $type = request('type');

        $industries = Industry::query()
            ->select('industries.*', 'profiles.is_recommand')
            ->orderBy('updated_at', 'desc')
            ->leftJoin('profiles', 'profiles.user_id', '=', 'industries.user_id');

        if($type == 'agent') {
            $user_ids = \App\Models\Backend\Profile::where('type', \App\Models\Backend\Category::TYPE_AGENT)
                ->select('user_id')
                ->pluck('user_id');
            $industries = $industries->whereIn('industries.user_id', $user_ids);
        }
        else if($type == 'manufacturer') {
            $user_ids = \App\Models\Backend\Profile::where('type', \App\Models\Backend\Category::TYPE_MANUFACTURER)
                ->select('user_id')
                ->pluck('user_id');

            $industries = $industries->whereIn('industries.user_id', $user_ids);
        }
        else if($type == 'user') {
            $user_ids = \App\Models\Backend\Profile::where('type', \App\Models\Backend\Category::TYPE_USER)
                ->select('user_id')
                ->pluck('user_id');

            $industries = $industries->whereIn('industries.user_id', $user_ids);
        }

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
            ->addAction(['width' => '20%'])
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
            '商户名称' => ['name' => 'display_name', 'data' => 'display_name'],
            '用户ID' => ['name' => 'user_id', 'data' => 'user_id'],
            '商户图片' => ['name' => 'avatar', 'data' => 'avatar', 'render' => render_image()],
            #'pic_urls' => ['name' => 'pic_urls', 'data' => 'pic_urls'],
            #'identity_urls' => ['name' => 'identity_urls', 'data' => 'identity_urls'],
            #'prov_id' => ['name' => 'prov_id', 'data' => 'prov_id'],
            #'city_id' => ['name' => 'city_id', 'data' => 'city_id'],
            '简介' => ['name' => 'description', 'data' => 'description'],
            'QQ号码' => ['name' => 'qq', 'data' => 'qq'],
            '微信号' => ['name' => 'wechat', 'data' => 'wechat'],
            '联系方式' => ['name' => 'phone', 'data' => 'phone'],
            '地址' => ['name' => 'address', 'data' => 'address'],
            '主营业务' => ['name' => 'service', 'data' => 'service'],
            #'描述' => ['name' => 'description', 'data' => 'description']
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
