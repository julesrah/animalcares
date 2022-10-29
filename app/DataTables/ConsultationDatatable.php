<?php

namespace App\DataTables;

use App\Models\Pets;
use App\Models\Consultation;
use App\Models\Employee;
use App\Models\Injury;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ConsultationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $consultations =  Consultation::with(['pet:id,name','injuries:description','employee:id,lname',])->select('consultation.*');

        return datatables()
            ->eloquent($consultations)
                    ->addColumn('action', function($row) {
                                        return "
                                        <form action=". route('consultation.destroy', $row->id). " method= \"POST\" >". csrf_field() .
                     '<input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                          </form>';
                                })
                    ->addColumn('injuries', function (Consultation $consultations) {
                                        return $consultations->injuries->map(function($injuries) {
                                            return "<li>".$injuries->description. "</li>";
                                        })->implode('<br>');
                                    })
                    ->addColumn('pet', function (Consultation $consultations) {
                                        return $consultations->pet->name;
                                    })
                    ->addColumn('employee', function (Consultation $consultations) {
                                        return $consultations->employee->lname;
                })
            ->rawColumns(['injuries','pet','action','employee']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ConsultationDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
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
                    ->setTableId('consultations-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('id'),
            Column::make('pet')->name('pet.name')->title('Pet Name'),
            Column::make('employee')->name('employee.lname')->title('Employee Name'),
            Column::make('injuries')->name('injuries.description')->title('Injuries/Diseases'),
            Column::make('comment'),
            Column::make('price'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Consultation_' . date('YmdHis');
    }
}