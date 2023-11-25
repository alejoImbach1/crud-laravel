<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from producto");
        return view("welcome")->with("datos", $datos);
    }

    public function create(Request $request)
    {
        try {
            $sql = DB::insert(
                "insert into producto(id_producto,nombre,precio,cantidad) values(?,?,?,?)",
                [
                    $request->txtcodigo,
                    $request->txtnombre,
                    $request->txtprecio,
                    $request->txtcantidad
                ]
            );
            return back()->with("correcto", "Producto agregado con éxito");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "¡Error al registrar!");
        }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update("update producto set nombre=?, precio=?, cantidad=?
            where id_producto=?", [
                $request->txtnombre,
                $request->txtprecio,
                $request->txtcantidad,
                $request->txtcodigo
            ]);
            return back()->with("correcto", "Se actualizó el producto con éxito");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "¡Error al actualizar!");
        }
    }

    public function delete($id) {
        try {
            $sql = DB::delete("delete from producto where id_producto=$id");
            return back()->with("correcto", "Se eliminó correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "¡Error al eliminar!");
        }
    }
}
