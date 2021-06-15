<div>
    <h1>Atualize sua foto:</h1>
    <form action="#" method="POST" wire:submit.prevent="storagePhoto">
        <label for="photo">Selecione a sua foto:</label>
        <input type="file" wire:model="photo">
        @error('photo') {{$message}} @endif
        <button type="submit">Enviar</button>
    </form>
</div>

