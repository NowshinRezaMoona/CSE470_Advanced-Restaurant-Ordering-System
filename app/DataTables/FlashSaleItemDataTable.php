<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                if ($query && $query->id) {
                    return "<a href='" . route('admin.flash-sale.destory', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                }
                return 'Action unavailable';
            })
            ->addColumn('product_name', function ($query) {
                if ($query && $query->product) {
                    return "<a href='" . route('admin.products.edit', $query->product->id) . "'>" . $query->product->name . "</a>";
                }
                return 'No product available';
            })
            ->addColumn('status', function ($query) {
                if ($query && $query->id) {
                    $checked = $query->status == 1 ? 'checked' : '';
                    return '<label class="custom-switch mt-2">
                                <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-status">
                                <span class="custom-switch-indicator"></span>
                            </label>';
                }
                return '';
            })
            ->addColumn('show_at_home', function ($query) {
                if ($query && $query->id) {
                    $checked = $query->show_at_home == 1 ? 'checked' : '';
                    return '<label class="custom-switch mt-2">
                                <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-at-home-status">
                                <span class="custom-switch-indicator"></span>
                            </label>';
                }
                return '';
            })
            ->rawColumns(['status', 'show_at_home', 'action', 'product_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        // Eager load the 'product' relationship to avoid null errors
        return $model->newQuery()->with('product');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('product_name'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
