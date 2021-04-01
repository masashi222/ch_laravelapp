<?php
namespace App\Http\Composers;

use Illuminate\View\View;

class PeriodSelectFormComposer
{
    public function compose(View $view) {
        $form_items['action'] = $view->form_items['action'];
        $form_items['year'] = "<option>" . $view->form_items['year'] . "</option>";
        $form_items['month'] = "<option>" . $view->form_items['month'] . "</option>";
        $view->with('form_items',$form_items);
    }
}