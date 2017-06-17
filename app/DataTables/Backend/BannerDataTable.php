<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Banner;
use Form;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Http\Request;

class BannerDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.banners.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $banners = Banner::query();
        /*
        if(isset($_GET['type']) && !in_array($_GET['type'], array(0,1,2))) {
            $banner
        }
         */
        if(_get('category_ids') != '') {
            $banners->where('display_name', _get('category_ids'));
        }
        else {
            $banners->whereIn('type', array(0,1,2));
        }

        return $this->applyScopes($banners);
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
            '展示名称' => ['name' => 'display_name', 'data' => 'display_name'],
            '外链地址' => ['name' => 'url', 'data' => 'url'],
            '图片' => ['name' => 'pic_url', 'data' => 'pic_url', 'render' => render_image()],
            '类型' => ['name' => 'type', 'data' => 'type'],
            '描述' => ['name' => 'description', 'data' => 'description']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'banners';
    }
}
