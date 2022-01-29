<?php

namespace App\Http\Controllers\API\Product;

use DB;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\MProduct;

use VerifyPerintis;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $product = MProduct::selectRaw('id as productId, name as productName, description as productDescription, created_by as createdBy, created_at as createdAt, updated_by as updatedBy, updated_at as updatedAt')->get();

            return response()->json([
                'data'   => $product,
                'status' => true
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'data'   => $e->getMessage(),
                'status' => false
            ]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $userData = VerifyPerintis::decodePerintisKey($request->header('perintis-key'));

            $mProduct              = new MProduct;
            $mProduct->name        = $request->productName;
            $mProduct->description = $request->productDescription;
            $mProduct->created_by  = $userData->userId;
            $mProduct->created_at  = date('Y-m-d H:i:s');
            $mProduct->save();

            return response()->json([
                'status'  => true,
                'message' => 'Berhasil menambahkan Product'
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal menambahkan Product'
            ]);
        }
    }

    public function show(Request $request, $id)
    {
        try
        {
            $product = MProduct::selectRaw('id as productId, name as productName, description as productDescription, created_by as createdBy, created_at as createdAt, updated_by as updatedBy, updated_at as updatedAt')
                ->where('id', $id)
            ->first();

            return response()->json([
                'status' => true,
                'data'   => $product
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $userData = VerifyPerintis::decodePerintisKey($request->header('perintis-key'));

            $mProduct              = MProduct::find($id);
            $mProduct->name        = $request->productName;
            $mProduct->description = $request->productDescription;
            $mProduct->updated_by  = $userData->userId;
            $mProduct->updated_at  = date('Y-m-d H:i:s');
            $mProduct->save();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengubah Product'
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            $mProduct = MProduct::find($id)->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Berhasil menghapus Product'
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
