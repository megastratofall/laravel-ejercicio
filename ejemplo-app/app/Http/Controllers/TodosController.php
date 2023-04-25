<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /*index para mostrar todos los tudus
     store para guardar un todo
     update para actualizar un todo
     destroy para eliminar un todo
     edit para mostrar el formulario de edicion
     */

    /*va recibir un parametro, vamos a recibir una solicitud http, cuando damos clic
     en nuestro fomulario para enviar nuestro datos, lo interesante es que deberíamos 
     validar los datos que nos lleguen, acá con laravel tenemos la posibilidad de hacerlo super sencillo
     con el validate, que pasa si no se cumple, entonces no va a proceder con todo lo demás. Una 
     vez que tengamos nuestra validación entonces podemos proceder a crear nuestro todo*/
    /*con esto podríamos guardar un nuevo elemento */
    public function store(Request $request)
    {
        //validamos primero
        $request->validate([
            'title' => 'required|min:3',
        ]);
        //creamos el objeto y asignamos los valores
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        //redirect me va a pedir una ruta, redirigimos al usuario a una ruta determinada
        //with con este mensaje que se inyectará en la solicitud de respuesta.
        //como probamos esto?, creando una ruta. en routes.
        return redirect()->route('todos')->with('success', 'Todo created successfully');
    }

    /*si quisiera mostrar todas las tareas que tengo en mi base de datos
    voy a usar mi modelo Todo y voy a mandar a llamar al metodo estatico all y 
    no necesito crear un nuevo valor porque solo necesito crearlo cuando 
    cree un nuevo valor, como en este caso necesito solo consultar, pongo all
    retorno la vista y en formato de array, pongo todos y mi variale de $todos
    ahora tengo que ir a las rutas para crear una y mostrar mis todos.*/

    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    //show 
    public function show($id)
    {
        $todo = Todo::find($id);
        $categories = Category::all();
        return view('todos.show', ['todo' => $todo, 'categories' => $categories]);
    }

    //update
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);

        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Todo updated successfully');
    }

    //destroy
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'Todo deleted successfully');
    }
}
