<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public static $products = [
        ["id"=>"1", "name"=>"TV", "description"=>"Best TV", "price"=>"120"],
        ["id"=>"2", "name"=>"iPhone", "description"=>"Best iPhone", "price"=>"999"],
        ["id"=>"3", "name"=>"Chromecast", "description"=>"Best Chromecast", "price"=>"49"],
        ["id"=>"4", "name"=>"Glasses", "description"=>"Best Glasses", "price"=>"75"]
    ];

    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] =  "List of products";
        $viewData["products"] = ProductController::$products;
        return view('product.index')->with("viewData", $viewData);
    }

    public function show(string $id): View | RedirectResponse
    {
        // Validate that the id is a positive integer and within range
        if (!ctype_digit($id)) {
            return redirect()->route('home.index');
        }

        $index = (int)$id;
        if ($index < 1 || $index > count(ProductController::$products)) {
            return redirect()->route('home.index');
        }

        $viewData = [];
        $product = ProductController::$products[$index - 1];
        $viewData["title"] = $product["name"]." - Online Store";
        $viewData["subtitle"] =  $product["name"]." - Product information";
        $viewData["product"] = $product;
        return view('product.show')->with("viewData", $viewData);
    }
    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData["title"] = "Create product";

        return view('product.create')->with("viewData",$viewData);
    }

    public function save(Request $request): View
    {
        $request->validate([
            "name" => "required",
            "price" => "required|numeric|gt:0",
        ]);

        $viewData = [];
        $viewData["title"] = "Product created";
        $viewData["message"] = "Product created successfully!";
        return view('product.success')->with("viewData", $viewData);
        //here will be the code to call the model and save it to the database
    }
}
