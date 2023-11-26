<?php

use App\Livewire\Bag\ManageBag;
use App\Livewire\Package\CreateForm;
use App\Livewire\Invoice\ShowReceipt;
use App\Livewire\Bag\ShowBag;
use App\Livewire\Package\ShowPackage;
use App\Livewire\Delivery\IndexDelivery;
use App\Livewire\Distribution\IndexDistribution;
use App\Livewire\Distribution\UnpackPackage;
use App\Livewire\Employee\IndexEmployee;
use App\Livewire\Tracking\SearchPackage;
use App\Livewire\Tracking\ShowPackageInfo;
use App\Livewire\Transport\ManageTransport;
use App\Livewire\Vehicle\IndexVehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/find-package', [SearchPackage::class, '__invoke'])->name('find-package');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ShowPackage::class, '__invoke'])->name('package.all');
    Route::get('/package', [CreateForm::class, '__invoke'])->name('package');
    Route::get('/package/all', [ShowPackage::class, '__invoke'])->name('package.all');
    Route::get('/receipt/{invoice_id}', [ShowReceipt::class, '__invoke'])->name('show-receipt');
    Route::get('/bag', [ShowBag::class, '__invoke'])->name('show-bag');
    Route::get('/bag/manage', [ManageBag::class, '__invoke'])->name('manage-bag');
    Route::get('/vehicle', [IndexVehicle::class, '__invoke'])->name('manage-vehicle');
    Route::get('/transportation', [ManageTransport::class, '__invoke'])->name('manage-transport');
    Route::get('/distribution', [IndexDistribution::class, '__invoke'])->name('manage-distribution');
    Route::get('/unpack', [UnpackPackage::class, '__invoke'])->name('unpack-package');
    Route::get('/delivery', [IndexDelivery::class, '__invoke'])->name('manage-delivery');
    Route::get('/tracking/{tracking}', [ShowPackageInfo::class, '__invoke'])->name('show-tracking');
    Route::get('/employee', [IndexEmployee::class, '__invoke'])->name('manage-employee');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
});

