<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;
use App\Models\alert;
use App\Models\product;
use App\Models\purchase;

class Products extends Component
{

    use WithPagination;

    public $whereDate = '';

    public $productModal = false;
    public $updateModal = false;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 50;

    public $name;
    public $price;
    public $description;

    public function thisDay()
    {
        $this->whereDate = now()->format('Y-m-d');
    }

    public function thisWeek()
    {
        $this->whereDate = now()->subDays(7)->format('Y-m-d');
    }

    public function thisMonth()
    {
        $this->whereDate = now()->subDays(30)->format('Y-m-d');
    }

    public function thisYear()
    {
        $this->whereDate = now()->subYear()->format('Y-m-d');
    }

    public function newProductModal()
    {
        $this->productModal = true;
    }

    public function addProduct()
    {
        $product = new product();
        $product->user_id = Auth::user()->id;
        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;
        $product->save();

        $alert = new alert();
        $alert->title = 'Nouveau Produit';
        $alert->description = 'Vous avez ajouté avec succès un nouveau produits dans votre liste de produits et services';
        $alert->icon = 'bi bi-basket3';
        $alert->user_id = Auth::user()->id;
        $alert->save();


        $this->reset();

        $this->productModal = false;
    }

    public function updateProductModal($id)
    {
        $this->updateModal = true;
    }

    public function render()
    {

        $products = product::where('description', 'like', '%'.$this->search.'%')
        ->where('user_id', Auth::user()->id)
        ->with('sales')
        ->orderBy('id', 'desc')
        ->get();

        return view('livewire.products', compact('products'));
    }
}
