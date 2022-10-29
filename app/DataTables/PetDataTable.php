<?php

namespace App\DataTables;

use App\Models\Pets;
use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PetDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
   public function dataTable($query)
    {
        $pets =  Pets::with(['customer:id,fname'])->select('pets.*');
        return datatables()
            ->eloquent($pets)
            ->addColumn('action', function($row) {
                                return "
                                <a href=". route('pets.edit', $row->id). " class=\"btn btn-light\">Edit</a>
                                <a href=". route('pets.shows', $row->id). " class=\"btn btn-light\">Show</a> 
                                <form action=". route('pets.destroy', $row->id). " method= \"POST\" >". csrf_field() .
             '<input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                                  </form>';
                        })
            ->addColumn('customer', function (Pets $pets) {
                                return $pets->customer->fname;
                            })
            ->addColumn('images', function ($pets) { 
                        $url=asset("$pets->img_path"); 

        return '<img src='.$url.' border="0" height="150" width="150" class="img-rounded" align="center">'; 
            })
            ->rawColumns(['customer','action','images']);
            // ->escapeColumns([]);
            //dd($pets);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PetDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pets $model)
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
                    ->setTableId('pets-table')
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
            Column::make('id')->title('Pet ID'),
            Column::make('customer')->name('customer.fname')->title('Owner'),
            Column::make('name')->title('Pet Name'),
            Column::make('type')->title('Pet Type'),
            Column::make('breed')->title('Pet Breed'),
            Column::make('images')->title('Image'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Pets_' . date('YmdHis');
    }
}
