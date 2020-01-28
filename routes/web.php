<?php


Route::get('/', function () {
    return view('welcome');
});
Route::get('/employee', 'EmployeeController@index') -> name('employee.index');

Route::get('/employee/create', 'EmployeeController@create') -> name('employee.create');
Route::post('/employee/store','EmployeeController@store') -> name('employee.store');

Route::get('/employee/{ide}/remove/task/{idt}','ExtraController@removeTaskFromEmployee') -> name('employee.task.remove');

Route::get('/employee/{id}/edit', 'EmployeeController@edit') -> name('employee.edit');
Route::post('/employee/{id}/update','EmployeeController@update') -> name('employee.update');