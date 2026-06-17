<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomStoreRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $rooms = Room::all();

            return view('Room.index', compact('rooms'))->with('status');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();

            return view('Room.index')->with('status', "Não foi possível recuperar as salas: '{$errorMessage}'");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        try {
            $room = Room::create()->fill($request->all());
            // $room->save();

            return to_route('rooms.index')->with('status', "Quarto: '{$room->name}' criado com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();

            return to_route('rooms.index')->with('status', "Não foi possível criar o quarto: '{$errorMessage}'");
        }
    }

    /**
     * Display the specified resource.
     */
    // usando Route Model Blinding, o laravel vai executar pro debaixo dos panos: Rooms::findOrFail(valorPassadoPorParametro == valor do parâmetro $room, que será um id), logo, caso não encontre, já executará um erro do status 404 == not found
    public function show(Room $room)
    {
        // devido ao Route Model Blinding, ele tentará encontar um registro na tabela Rooms com o valor passado pela rota até este método aqui (valor que estará presente em $room, porém $room será convertida para um objeto do tipo Room caso o valor passado pela rota até o método show realmente existir na tabela Rooms, pois por debaixo dos panos, essa linha de parâmetro: Room $room, pega o valor recebido pela rota jogando em $room (normalmente um id) e roda: Room::findOrFail(valorPassadoPelaRotaAtéOmétodoShowVulgoMetodoAtual), caso encontre, passa esse objeto do tipo room para nosso método show atual, se não, retorna um status 404 == não encontrado, logo, não precisamos ficar tratando com try - catch, pois usando Route Model Blinding, ele dificilmente leria o nosso catch em caso de erro pois ele só entra no método show SE ENCONTRAR o objeto que procuramos com base no valor (id) que recebemos por parâmetro pela rota do tipo get)
        return view('Room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('Room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        try {
            $room->update($request->all());
            return to_route('rooms.index')->with('status', "Quarto: '{$room->name}' atualizado com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('rooms.index')->with('status', "Não foi possível atualizar o quarto '{$room->name}', Erro: '{$errorMessage}'");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();

            return to_route('rooms.index')->with('status', "Quarto: '{$room->name}' deletado com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();

            return to_route('rooms.index')->with('status', "Não foi possível excluír o quarto: '{$errorMessage}'");
        }
    }
}
