<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reserve\{ReserveStoreRequest, ReserveUpdateRequest};
use App\Models\{Reserve, Room, User};
use Carbon\Carbon;
use Error;

class ReserveController extends Controller
{

    protected function findUnavaliableTimes(int $roomId): array
    {
        $reservasAtivas = Reserve::where('room_id', $roomId)->get();

        $horariosIndisponiveis = [];
        

        foreach ($reservasAtivas as $reservaAtiva) {
            $horariosIndisponiveis[] = Carbon::parse($reservaAtiva->start_time)->format('H:i'); // não é possível utilizar o método format em strings (nosso campo start_time estava sendo considerado uma string, logo, convertemos ele para um objeto carbon com o Carbon::parse(o que queremos converter para um objeto carbon) e depois pegamos esse resultado e ai aplicamos o format(H:i) para nos trazer, da data que estamos passando (que está em $reservaAtiva->start_time) apenas a hora (H) e os minutos (i))
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
                $horariosDisponiveis[] = $horario;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reserves = Reserve::all();
            return view('Reserve.index', compact('reserves'))->with('status');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return view('Reserve.index')->with('status', "Não foi possível recuperar as reservas '{$errorMessage}'");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Reserve.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReserveStoreRequest $request)
    {
        try {
            $horariosDisponiveis = $this->horariosDisponiveis($request->room_id);
            // quando preencho um campo de formulário do tipo date (html/blade) ele me envia num formato diferente do formato que meus horários disponíveis estão (H:i == hora e minuto), então para que eu possa comparar se meu horário passado pelo formulário está no meu formato dos horários disponíveis para reserva eu preciso converter o horário passado pelo formulário para o mesmo formato que os horários disponiveis estão, onde primeiro converto para um objeto do tipo carbon e depois formato a data nele presente para hora e minuto
            $horarioFormulario = Carbon::parse($request->start_time)->format('H:i');

            if (in_array($horarioFormulario, $horariosDisponiveis)) {
                Reserve::create([
                    'user_id' => $request->user_id,
                    'room_id' => $request->room_id,
                    'reserve_date' => $request->reserve_date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'observation' => $request->observation
                ]);
                return to_route('reserves.index')->with('status', "Reserva realizada com sucesso!");
            }

            throw new Error("Horário '$request->start_time' indisponível para reservas.");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('status', "Não foi possível realizar a reserva '{$errorMessage}'");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserve $reserf)
    {
        try {
            return view('Reserve.show', compact('reserf'));
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('status', "Não foi possível recuperar a reserva '{$errorMessage}'");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserve $reserf)
    {
        try {
            return view('Reserve.edit', compact('reserf'));
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('status', "Não foi possível recuperar a reserva '{$errorMessage}'");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReserveUpdateRequest $request, Reserve $reserf)
    {
        try {
            $reserf->update($request->all());
            return to_route('reserves.index')->with('status', 'Reserva atualizada com sucesso!');
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('status', "Não foi possível atualizar a Reserva: '{$errorMessage}'");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserve $reserf)
    {
        try {
            $reserf->delete();

            return to_route('reserves.index')->with('status', "Reserva foi excluída com sucesso!");
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            return to_route('reserves.index')->with('status', "Não foi possível excluir a reserva: '{$errorMessage}'");
        }
    }
}
