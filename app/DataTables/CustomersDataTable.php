<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $customers =  Customer::withTrashed()->with('user');
        // $customers =  Customer::with(['pets']);
       return datatables()
            ->eloquent($customers)
             ->addColumn('action', function($row) {
                    if ($row->deleted_at)
                    return '<a href="'. route('customer.restore', $row->id). '" class="btn btn-warning">Reactivate</a>';
                else
                    return
                    '<a href="'. route('customer.show', $row->id). '" class="btn btn-warning">Show</a>
                    <form action="'. route('customer.destroy', $row->id). '"method="POST">'. csrf_field() .'
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Deactivate</button>
                    </form>';
            })
             // ->addColumn('pets', function (Customer $customers) {
             //        return $customers->pets->map(function($pets) {
             //            return "<li>".$pets->name. "</li>";
             //        })->implode('<br>');
             //    })
            ->addColumn('images', function ($customers) { 
                        $url=asset("$customers->img_path"); 
       return '<img src='.$url.' border="0" height="150" width="150" class="img-rounded" align="center">'; 
            })
            // ->rawColumns(['images','action','pets']);
            ->rawColumns(['images','action']);
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
                    ->setTableId('customers-table')
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
            Column::make('id')->title('Customer ID'),
            Column::make('images')->title('Image'),
            // Column::make('pets')->name('pets.name')->title('Pets Owned'),
            Column::make('title')->title('Title'),
            Column::make('lname')->title('Last Name'),
            Column::make('fname')->title('First Name'),
            Column::make('addressline')->title('Address'),
            Column::make('town')->title('Town'),
            Column::make('zipcode')->title('Zipcode'),
            Column::make('phone')->title('Phone'),
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
        return 'Customers_' . date('YmdHis');
    }
}