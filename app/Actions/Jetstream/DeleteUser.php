<?php

namespace App\Actions\Jetstream;

use App\Models\FilmesAssistidos;
use App\Models\ListaDoUsuario;
use App\Models\Movie_votes;
use App\Models\RelacionamentoListaFilme;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $listasDoUsuario = ListaDoUsuario::where('id_usuario', $user->id)->get();
        foreach ($listasDoUsuario as $lista) {
            RelacionamentoListaFilme::where('id_lista', $lista->id)->delete();
        }
        $listasDoUsuario->each->delete();
        Movie_votes::where('user_id', $user->id)->delete();
        FilmesAssistidos::where('id_usuario', $user->id)->delete();
        $user->delete();
    }
}
