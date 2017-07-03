<?php

namespace App\DataTables\Backend;

use App\Models\Backend\Score;
use Form;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Http\Request;

class ScoreDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'backend.scores.datatables_actions')
			->editColumn('total_amount', function($data) {
				$profile = \App\Models\Backend\Profile::where('user_id', $data->user_id)->first();
				return $profile->total_amount;
			})
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $scores = Score::query();
		$user_id = isset($_GET['user_id'])?$_GET['user_id']: '';
        if($user_id != '') 
            $scores->where('user_id', $user_id);
        if(!access()->hasRole('Administrator')) 
            $scores->where('user_id', access()->user()->id);

        return $this->applyScopes($scores);
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
            #->addAction(['width' => '10%', 'title' => '操作'])
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
            '订单编号' => ['name' => 'id', 'data' => 'id'],
            '用户ID' => ['name' => 'user_id', 'data' => 'user_id'],
            '出／入账积分' => ['name' => 'amount', 'data' => 'amount'],
            '用途' => ['name' => 'typename', 'data' => 'typename'],
            '操作详情' => ['name' => 'description', 'data' => 'description'],
            '当前积分' => ['name' => 'current_amount', 'data' => 'current_amount'],
            '历史积分' => ['name' => 'total_amount', 'data' => 'total_amount'],
            '操作时间' => ['name' => 'created_at', 'data' => 'created_at'],
            '操作' => ['name' => 'action', 'data' => 'action'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'scores';
    }
}
