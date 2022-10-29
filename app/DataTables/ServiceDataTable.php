<?php

namespace App\DataTables;

use App\Models\Services;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $data = Services::latest()->get();
        return datatables()
            ->eloquent($query)
             ->addColumn('action', function($row) {
                    return "<a href=". route('services.edit', $row->id). " class=\"btn btn-warning\">Edit</a>
                    <a href=". route('services.show', $row->id). " class=\"btn btn-light\">Show</a>
                    <form action=". route('services.destroy', $row->id). " method= \"POST\" >". csrf_field().
                    '<input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                      </form>';
                })
             ->addColumn('images', function ($services) {
                   $images = explode("|",$services->img_path); 
                   $collection = collect($images);
                    return $collection->map(function($p) {
                        $url = url('../images/'.$p);
                        return '<img src="'.$url.'" border="0" width="90" height="90" align="center">';
                  })->implode('<br>');
            })
             ->rawColumns(['action','images','services']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ServiceDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Services $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('services-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [    
            Column::make('id')->title('Grooming Service ID'),
            Column::make('images')->title('Image'),
            Column::make('description')->title('Description'),
            Column::make('price')->title('Price'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Services_' . date('YmdHis');
    }
}