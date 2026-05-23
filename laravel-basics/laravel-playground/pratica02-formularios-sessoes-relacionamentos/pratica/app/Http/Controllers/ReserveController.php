<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reserve\ReserveStoreRequest;
use App\Http\Requests\Reserve\ReserveUpdateRequest;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{

    protected function findUnavaliableTimes(int $roomId): array
    {
        $reservasAtivas = Reserve::where('room_id', $roomId)->get();

        $horariosIndisponiveis = [];

        foreach ($reservasAtivas as $reservaAtiva) {
            $horariosIndisponiveis[] = $reservaAtiva->start_time;
        }

        return $horariosIndisponiveis;
    }

    protected function findAvaliableTimes(array $horariosIndisponiveis): array
    {
        $horarios = [
            '08:00',
            '10:00',
            '12:00',
            '14:00',
            '16:00',
            '18:00',
            '20:00'
        ];

        $horariosDisponiveis = [];

        foreach ($horarios as $horario) {
            if (!in_array($horario, $horariosIndisponiveis)) {
                $horariosDisponiveis = $horario;
            }
        }

        return $horariosDisponiveis;
    }

    protected function horariosDisponiveis(int $roomId): array
    {
        $horariosIndisponiveis = $this->findUnavaliableTimes($roomId);
        $horariosDisponiveis = $this->findAvaliableTimes($horariosIndisponiveis);

        return $horariosDisponiveis;
    }

    public function reserve(Request $request): void
    {
        # code...
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reserves = Reserve::all();
            return view('reserves.index', compact('reserves'))->with('message.status');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('message.status', "Não foi possível recuperar as reservas '{$errorMessage}'");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reserves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReserveStoreRequest $request)
    {
        try {
            Reserve::create()->fill($request->all());

            return to_route('reserves.index')->with('mensagem.sucesso', "Reserva criada com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('message.status', "Não foi possível realizar a reserva '{$errorMessage}'");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $reserve = Reserve::findOrFail($id);
            return view('reserves.show', compact('reserve'));
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('message.status', "Não foi possível recuperar a reserva '{$errorMessage}'");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $reserve = Reserve::findOrFail($id);
            return view('reserves.edit', compact('reserve'));
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('message.status', "Não foi possível recuperar a reserva '{$errorMessage}'");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReserveUpdateRequest $request, Reserve $reserve)
    {
        try {
            $reserve->update($request->all());
            return to_route('reserves.index')->with('message.status', 'Reserva atualizada com sucesso!');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('message.status', "Não foi possível atualizar a Reserva: '{$errorMessage}'");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Reserve::destroy($id);

            return to_route('reserve.index')->with('message.status', "Reserva com id:'{$id}' foi excluída com sucesso!");
        } catch (\Throwable $th) {
            $th->getMessage();
            return to_route('reserves.index', "Não foi possível excluir a reservacom id: '{$id}'.");
        }
    }
}
