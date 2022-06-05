<?php
namespace Scandiweb\App\Controllers;

use Scandiweb\Lib\Core\Controller;
use Scandiweb\Lib\Core\Response;
use Scandiweb\Lib\Core\Request;
use Scandiweb\Lib\Core\Validation;
use Scandiweb\App\Models\Product;
/**
 * Description of Product
 *
 * @author Sune
 */
class ProductController extends Controller
{
    public function index(Request $req, Response $res) {
        $product = new Product();
        $products = $product->findAll();
        return $res->render('home', ['products' => $products]);
    }

    public function addProductForm(Request $req, Response $res)
    {
        return $res->render('add-product');
    }

    public function addProduct(Request $req, Response $res)
    {
        $form = new Validation();
        $product = new Product();
        $form->validate($req, [
            'sku' => ['required' => true, 'unique' => true, 'model' => Product::class],
            'name' => ['required' => true],
            'price' => ['required' => true, 'numeric' => true],
            'type_switcher' => ['required' => true],
        ]);
        if ($form->isValidated()) {
            $height = $req->getInput('height');
            $width = $req->getInput('width');
            $length = $req->getInput('length');
            $size = !empty($req->getInput('size')) ? 'Size: ' . $req->getInput('size') . ' MB' : null;
            $weight = !empty($req->getInput('weight')) ? 'Weight: ' . $req->getInput('weight') . 'KG' : null;
            $dimension = !empty($req->getInput('height')) && !empty($req->getInput('width')) && !empty($req->getInput('length')) ? 'Dimension: ' . $height.'x'.$width.'x'.$length : null;

            $type = $size ?? $dimension ?? $weight;

            $product->setSku($req->getInput('sku'));
            $product->setName($req->getInput('name'));
            $product->setPrice($req->getInput('price'));
            $product->setType($type); 
            $product->add();
            return $res->toJson(['ok' => true]);
        } else {
            return $res->toJson(['form' => $form]);
        }
    }

    public function massDelete(Request $req, Response $res)
    {
        $product = new Product();
        $product_sku = $req->getPost('product_sku');
        $product->removeMany('sku', $product_sku);
        return $res->toJson(['ok' => true, 'p_sku' => $product_sku]);
    }
}
