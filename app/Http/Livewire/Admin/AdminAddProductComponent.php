<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_discription;
    public $description;
    public $regular_price;
    public $stock_status;
    public $quantity;
    public $image;
    public $category_id;
    public $images;

    public function mount()
    {
       $this->stock_status = 'instock'; 
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addProduct()
    {
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_discription = $this->short_discription;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->stock_status = $this->stock_status;
        $product->quantity = $this->quantity;
        $imageName = Carbon::now()->timestamp. '.' .$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image = $imageName;

        if($this->images)
        {
            $imagesname = '';
            foreach ($this->images as $key => $image) 
            {
      
                $imgName = Carbon::now()->timestamp. $key. '.' .$image->extension();
                $image->storeAs('products',$imgName);
                $imagesname = $imagesname . ',' . $imgName;
                
            }
            $product->images = $imagesname;
        }

        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message','Product has been created successfully!');
        return redirect()->to('/admin/products');


    }
    
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}
