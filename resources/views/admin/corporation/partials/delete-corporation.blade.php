<section>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Удалить корпорацию') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Как только корпорация будет удалена, все ее ресурсы и данные будут удалены безвозвратно. Перед удалением корпорации, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.') }}
        </p>
    </header>

    <form action="{{ route('admin.corporation.delete', $corporation->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger btn-sm" value="Удалить корпорацию">
    </form>

</section>
