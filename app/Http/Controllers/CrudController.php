<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

class CrudController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from items");
        return view("welcome")->with("datos", $datos);
    }

    public function create(Request $request)
    {
        try {
            $sql = DB::insert(
                "insert into items(descripcion,fecha) values(?,?)",
                [
                    $request->txtdescripcion,
                    $request->txtfecha,
                ]
            );
            return back()->with("alert", ["Se agregó el item con éxito",'success']);
        } catch (\Throwable $th) {
            return back()->with("alert", "¡Error al registrar!");
        }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update("update items set descripcion=?, fecha=?
            where id_item=?", [
                $request->txtdescripcion,
                $request->txtfecha,
                $request->txtid
            ]);
            return back()->with("alert", ["Se actualizó el item con éxito",'success']);
        } catch (\Throwable $th) {
            return back()->with("alert", ["¡Error al actualizar!",'danger']);
        }
    }

    public function delete($id) {
        try {
            $sql = DB::delete("delete from items where id_item=$id");
            return back()->with('alert', ["Se eliminó correctamente",'warning']);
        } catch (\Throwable $th) {
            return back()->with('alert', ["¡Error al eliminar!",'danger']);
        }
    }
}
