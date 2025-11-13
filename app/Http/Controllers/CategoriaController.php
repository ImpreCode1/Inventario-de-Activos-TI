<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-categoria|crear-categoria|editar-categoria|borrar-categoria')->only('index');
        $this->middleware('permission:crear-categoria', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-categoria', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-categoria', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('categoria.index');
    }

    public function categorias()
    {
        if (Gate::denies('ver-categoria')) {
            abort(403);
        }

        $categorias = Categoria::select('id', 'nombre')->get();

        return datatables()->of($categorias)
            ->addColumn('acciones', function ($categoria) {
                $html = '<div class="d-flex justify-content-center align-items-center flex-wrap action-buttons">';
                if (auth()->user()->can('editar-categoria')) {
                    $html .= '<a href="/categorias/'.$categoria->id.'/edit"
                        class="btn-icon btn-outline-primary"
                        title="Editar">
                        <i class="fas fa-pen"></i>
                    </a>';
                }
                if (auth()->user()->can('borrar-categoria')) {
                    $html .= '<form id="form-eliminar-' . $categoria->id . '" 
                        action="'. route('categorias.destroy', $categoria->id) .'" 
                        method="POST" style="display: inline;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="button" class="btn-icon btn-outline-danger" 
                            title="Eliminar"
                            onclick="confirmDelete(' . $categoria->id . ')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>';
                }
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['acciones'])
            ->toJson();
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->save();

        return redirect('/categorias')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit')->with('categoria', $categoria);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
        ]);

        $categoria->nombre = $request->get('nombre');
        $categoria->save();

        return redirect('/categorias')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect('/categorias')->with('success', 'Categoría eliminada correctamente.');
    }
}
