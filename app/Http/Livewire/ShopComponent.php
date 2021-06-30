<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use Cart;

class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;

    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
    } 

    use WithPagination;
    public function render()
    {
        if ($this->sorting == 'date') 
        {            
            $products = Product::orderBy('created_at','DESC')->paginate($this->pagesize);            
        }
        elseif ($this->sorting == "price") 
        {
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pagesize);             
        }
        elseif ($this->sorting == "price-desc")
        {
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pagesize);                 
        }
        else
        {
            $products = Product::paginate($this->pagesize);     
        }


        $categories = Category::all();
        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}
