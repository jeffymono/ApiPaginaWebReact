<?php
namespace App\Http\Controllers;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
  /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get Categories
    public function showAllCategories()
    {
        return response()->json(Category::all());
    }
    public function showOneCategory($categoria_id)
    {
        return response()->json(Category::find($categoria_id));
    }
    // CRUD Authors
    public function createCategory(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }
    public function updateCategory($categoria_id, Request $request)
    {
        try{
            $category = Category::findOrFail($categoria_id);
            }
        catch(ModelNotFoundException $e)
        {
            return response('Categoría no encontrada', 404);
        }
        $category->update($request->all());
        return response()->json($category, 200);
    }
    public function deleteCategory($categoria_id)
    {
        try{
            Category::findOrFail($categoria_id)->delete();
            }
        catch(ModelNotFoundException $e)
        {
            return response('Categoría no encontrada', 404);
        }
        return response('Deleted Successfully', 200);
    }

        // CRUD Books
    public function createProduct($categoria_id, Request $request)
    {
        $category = Category::find($categoria_id);
        $product = Product::create([
            'pro_marca' => $request->pro_marca,
            'pro_modelo' => $request->pro_modelo,
            'pro_imagen' => $request->pro_imagen,
            'pro_descripcion' => $request->pro_descripcion,
            'pro_dimesiones' => $request->pro_dimesiones,
            'pro_estado' => $request->pro_estado,
            'categoria_id' => $category->id
        ]);
        return response()->json($product, 201);
    }
    // GET Books
    public function showAllProducts()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }
    public function showAllProductsFromCategory($categoria_id)
    {
        try{
        $category = Category::findOrFail($categoria_id);
        }
        catch(ModelNotFoundException $e){
            return response('Productos no encontrado', 404);
        }
        $products = $category->products;
        return response()->json($products, 200);
        
    }
    public function showOneProduct($categoria_id, $product_id)
    {
        try{
        $category = Category::findOrFail($categoria_id);
        }
        catch(ModelNotFoundException $e){
            return response('Producto no encontrado', 404);
        }
        $product = $category->products
                       ->where('id', '=', $product_id)
                       ->first();
        return response()->json($product, 200);
    }
    public function updateProduct($categoria_id, $product_id, Request $request)
    {
        try{
            $category = Category::findOrFail($categoria_id);
            }
            catch(ModelNotFoundException $e){
                return response('Producto no encontrado', 404);
            }
        $product = $category->products
                       ->where('id', '=', $product_id)
                       ->first()
                       ->update($request->all());

                       $updatedProduct = $category->products
                              ->where('id', '=', $product_id)
                              ->first();
        return response()->json($updatedProduct, 200);
    }

    public function deleteProduct($categoria_id, $product_id)
    {
        try{
            $category = Category::findOrFail($categoria_id);
            }
            catch(ModelNotFoundException $e){
                return response('Producto no encontrado', 404);
            }
        $product = $category->products
                       ->where('id', '=', $product_id)
                       ->first()
                       ->delete();
        return response('Book Deleted Successfully', 200);
    }
}